<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Blog;
use App\Models\Doctor;
use App\Models\DoctorBooking;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    /**
     * Show the admin dashboard.
     */
    public function dashboard()
    {
        $user = Auth::user();
        $isHospitalOwner = $user?->hasRole('hospital_owner');
        $driver = DB::connection()->getDriverName();

        $doctorCount = Doctor::query()
            ->when($isHospitalOwner, fn ($query) => $query->where('owner_id', $user->id))
            ->count();

        $bookingCount = DoctorBooking::query()
            ->when($isHospitalOwner, fn ($query) => $query->where('hospital_owner_id', $user->id))
            ->count();

        $pendingBookingCount = DoctorBooking::query()
            ->where('status', 'pending')
            ->when($isHospitalOwner, fn ($query) => $query->where('hospital_owner_id', $user->id))
            ->count();

        $stats = [
            'doctor_count' => $doctorCount,
            'booking_count' => $bookingCount,
            'pending_booking_count' => $pendingBookingCount,
            'pending_hospital_count' => $isHospitalOwner ? null : User::role('hospital_owner')->where('approval_status', 'pending')->count(),
            'blog_count' => $isHospitalOwner ? null : Blog::count(),
            'patient_count' => $isHospitalOwner ? null : User::role('patient')->count(),
            'appointment_count' => $isHospitalOwner ? null : Appointment::count(),
        ];

        $recentBookings = DoctorBooking::query()
            ->with(['doctor.owner'])
            ->when($isHospitalOwner, fn ($query) => $query->where('hospital_owner_id', $user->id))
            ->latest()
            ->take(8)
            ->get();

        $bookingStatusChart = DoctorBooking::query()
            ->select('status', DB::raw('COUNT(*) as total'))
            ->when($isHospitalOwner, fn ($query) => $query->where('hospital_owner_id', $user->id))
            ->groupBy('status')
            ->pluck('total', 'status');

        $monthlyBookingTrend = DoctorBooking::query()
            ->selectRaw(
                $driver === 'sqlite'
                    ? "strftime('%Y-%m', created_at) as month_key, strftime('%m/%Y', created_at) as month_label, COUNT(*) as total"
                    : "DATE_FORMAT(created_at, '%Y-%m') as month_key, DATE_FORMAT(created_at, '%b %Y') as month_label, COUNT(*) as total"
            )
            ->when($isHospitalOwner, fn ($query) => $query->where('hospital_owner_id', $user->id))
            ->where('created_at', '>=', now()->startOfMonth()->subMonths(5))
            ->groupBy('month_key', 'month_label')
            ->orderBy('month_key')
            ->get();

        return view('admin.dashboard', compact('stats', 'recentBookings', 'isHospitalOwner', 'bookingStatusChart', 'monthlyBookingTrend'));
    }
}
