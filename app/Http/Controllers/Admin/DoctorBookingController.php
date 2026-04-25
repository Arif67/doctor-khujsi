<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DoctorBooking;
use App\Models\DoctorBookingStatusHistory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class DoctorBookingController extends Controller
{
    public function analytics()
    {
        $query = DoctorBooking::query()
            ->leftJoin('doctors', 'doctor_bookings.doctor_id', '=', 'doctors.id')
            ->leftJoin('users as owners', 'doctor_bookings.hospital_owner_id', '=', 'owners.id');

        if (Auth::user()?->hasRole('hospital_owner')) {
            $query->where('doctor_bookings.hospital_owner_id', Auth::id());
        }

        $doctorAnalytics = (clone $query)
            ->selectRaw('doctor_bookings.doctor_id')
            ->selectRaw('COALESCE(doctors.name, "Deleted doctor") as doctor_name')
            ->selectRaw('COALESCE(owners.hospital_name, "Unassigned hospital") as hospital_name')
            ->selectRaw('COUNT(*) as total_bookings')
            ->selectRaw("SUM(CASE WHEN doctor_bookings.status = 'pending' THEN 1 ELSE 0 END) as pending_count")
            ->selectRaw("SUM(CASE WHEN doctor_bookings.status = 'confirmed' THEN 1 ELSE 0 END) as confirmed_count")
            ->selectRaw("SUM(CASE WHEN doctor_bookings.status = 'cancelled' THEN 1 ELSE 0 END) as cancelled_count")
            ->groupBy('doctor_bookings.doctor_id', 'doctors.name', 'owners.hospital_name')
            ->orderByDesc('total_bookings')
            ->get();

        return view('admin.bookings.analytics', compact('doctorAnalytics'));
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $query = $this->filteredQuery($request);

            return DataTables::of($query)
                ->addIndexColumn()
                ->addColumn('doctor', fn ($row) => $row->doctor?->name ?? 'Deleted doctor')
                ->addColumn('hospital', fn ($row) => $row->doctor?->owner?->hospital_name ?? $row->hospitalOwner?->hospital_name ?? '-')
                ->addColumn('patient_email', fn ($row) => $row->patient_email ?? '-')
                ->editColumn('created_at', fn ($row) => $row->created_at?->format('d M Y, h:i A'))
                ->editColumn('status', function ($row) {
                    $classes = match ($row->status) {
                        'confirmed' => 'bg-green-100 text-green-800',
                        'cancelled' => 'bg-red-100 text-red-800',
                        default => 'bg-yellow-100 text-yellow-800',
                    };

                    return '<span class="px-2 py-1 '.$classes.' text-xs rounded">'.ucfirst($row->status).'</span>';
                })
                ->addColumn('action', function ($row) {
                    $buttons = [
                        '<a href="'.route('admin.doctor-bookings.show', $row->id).'" class="px-3 py-2 bg-slate-600 hover:bg-slate-700 text-white text-sm font-medium rounded shadow transition">View</a>',
                    ];

                    foreach (['pending', 'confirmed', 'cancelled'] as $status) {
                        if ($row->status === $status) {
                            continue;
                        }

                        $classes = match ($status) {
                            'confirmed' => 'bg-green-600 hover:bg-green-700',
                            'cancelled' => 'bg-red-600 hover:bg-red-700',
                            default => 'bg-yellow-500 hover:bg-yellow-600 text-dark',
                        };

                        $buttons[] = '
                            <form action="'.route('admin.doctor-bookings.update-status', $row->id).'" method="POST">
                                '.csrf_field().'
                                '.method_field('PATCH').'
                                <input type="hidden" name="status" value="'.$status.'">
                                <input type="hidden" name="status_reason" value="">
                                <button type="submit" class="px-3 py-2 '.$classes.' text-white text-sm font-medium rounded shadow transition">
                                    '.ucfirst($status).'
                                </button>
                            </form>';
                    }

                    return '<div class="flex flex-wrap gap-2">'.implode('', $buttons).'</div>';
                })
                ->rawColumns(['status', 'action'])
                ->make(true);
        }

        return view('admin.bookings.index');
    }

    public function show(DoctorBooking $doctorBooking)
    {
        $doctorBooking->load(['doctor.department', 'doctor.owner', 'hospitalOwner', 'statusHistory.changedBy']);

        if (Auth::user()?->hasRole('hospital_owner') && $doctorBooking->hospital_owner_id !== Auth::id()) {
            abort(403);
        }

        return view('admin.bookings.show', compact('doctorBooking'));
    }

    public function summary(Request $request)
    {
        $baseQuery = $this->filteredQuery($request);
        $summaryBase = clone $baseQuery;

        $statusCounts = (clone $summaryBase)
            ->select('status', DB::raw('COUNT(*) as total'))
            ->groupBy('status')
            ->pluck('total', 'status');

        $doctorSummary = (clone $baseQuery)
            ->leftJoin('doctors', 'doctor_bookings.doctor_id', '=', 'doctors.id')
            ->selectRaw('COALESCE(doctors.name, "Deleted doctor") as label, COUNT(*) as total')
            ->groupBy('doctors.id', 'doctors.name')
            ->orderByDesc('total')
            ->limit(5)
            ->get();

        $hospitalSummary = (clone $baseQuery)
            ->leftJoin('users as owners', 'doctor_bookings.hospital_owner_id', '=', 'owners.id')
            ->selectRaw('COALESCE(owners.hospital_name, "Unassigned hospital") as label, COUNT(*) as total')
            ->groupBy('owners.id', 'owners.hospital_name')
            ->orderByDesc('total')
            ->limit(5)
            ->get();

        return response()->json([
            'totals' => [
                'all' => (clone $baseQuery)->count(),
                'pending' => (int) ($statusCounts['pending'] ?? 0),
                'confirmed' => (int) ($statusCounts['confirmed'] ?? 0),
                'cancelled' => (int) ($statusCounts['cancelled'] ?? 0),
            ],
            'doctor_summary' => $doctorSummary,
            'hospital_summary' => $hospitalSummary,
        ]);
    }

    public function export(Request $request)
    {
        $fileName = 'doctor-bookings-'.now()->format('Y-m-d-His').'.csv';
        $query = $this->filteredQuery($request);

        return response()->streamDownload(function () use ($query) {
            $handle = fopen('php://output', 'w');
            fputcsv($handle, ['Patient', 'Phone', 'Email', 'Age', 'Doctor', 'Hospital', 'Status', 'Created At', 'Notes']);

            $query->orderByDesc('created_at')->chunk(200, function ($bookings) use ($handle) {
                foreach ($bookings as $booking) {
                    fputcsv($handle, [
                        $booking->patient_name,
                        $booking->patient_phone,
                        $booking->patient_email,
                        $booking->patient_age,
                        $booking->doctor?->name,
                        $booking->doctor?->owner?->hospital_name ?? $booking->hospitalOwner?->hospital_name,
                        $booking->status,
                        $booking->created_at?->format('Y-m-d H:i:s'),
                        $booking->notes,
                    ]);
                }
            });

            fclose($handle);
        }, $fileName, [
            'Content-Type' => 'text/csv',
        ]);
    }

    public function print(Request $request)
    {
        $bookings = $this->filteredQuery($request)
            ->orderByDesc('created_at')
            ->get();

        return view('admin.bookings.print', compact('bookings'));
    }

    public function updateStatus(Request $request, DoctorBooking $doctorBooking)
    {
        $user = Auth::user();

        if ($user?->hasRole('hospital_owner') && $doctorBooking->hospital_owner_id !== $user->id) {
            abort(403);
        }

        $data = $request->validate([
            'status' => ['required', 'in:pending,confirmed,cancelled'],
            'status_reason' => ['nullable', 'string', 'max:1000'],
        ]);

        $doctorBooking->loadMissing(['doctor.owner', 'hospitalOwner']);
        $fromStatus = $doctorBooking->status;
        $doctorBooking->update([
            'status' => $data['status'],
        ]);

        if ($fromStatus !== $data['status']) {
            DoctorBookingStatusHistory::create([
                'doctor_booking_id' => $doctorBooking->id,
                'changed_by' => Auth::id(),
                'from_status' => $fromStatus,
                'to_status' => $data['status'],
                'reason' => $data['status_reason'] ?? null,
            ]);
        }

        $recipients = array_filter(array_unique([
            $doctorBooking->patient_email,
            $doctorBooking->hospitalOwner?->email,
            $doctorBooking->doctor?->owner?->email,
        ]));

        if ($recipients !== []) {
            Mail::raw(
                "A booking for {$doctorBooking->patient_name} has been updated.\n\nDoctor: ".($doctorBooking->doctor?->name ?? 'N/A')."\nNew status: {$doctorBooking->status}\nPhone: {$doctorBooking->patient_phone}",
                function ($message) use ($recipients) {
                    $message->to($recipients)->subject('Doctor booking status updated');
                }
            );
        }

        return redirect()
            ->route('admin.doctor-bookings.index')
            ->with('success', 'Booking status updated successfully.');
    }

    public function updateNotes(Request $request, DoctorBooking $doctorBooking)
    {
        if (Auth::user()?->hasRole('hospital_owner') && $doctorBooking->hospital_owner_id !== Auth::id()) {
            abort(403);
        }

        $data = $request->validate([
            'notes' => ['nullable', 'string', 'max:2000'],
        ]);

        $doctorBooking->update([
            'notes' => $data['notes'],
        ]);

        return redirect()
            ->route('admin.doctor-bookings.show', $doctorBooking)
            ->with('success', 'Booking notes updated successfully.');
    }

    private function filteredQuery(Request $request)
    {
        $query = DoctorBooking::query()->with(['doctor.owner', 'hospitalOwner']);

        if (Auth::user()?->hasRole('hospital_owner')) {
            $query->where('hospital_owner_id', Auth::id());
        }

        if ($request->filled('status')) {
            $query->where('status', (string) $request->string('status'));
        }

        if ($request->filled('q')) {
            $term = trim((string) $request->string('q'));
            $query->where(function ($subQuery) use ($term) {
                $subQuery
                    ->where('patient_name', 'like', "%{$term}%")
                    ->orWhere('patient_phone', 'like', "%{$term}%")
                    ->orWhere('patient_email', 'like', "%{$term}%");
            });
        }

        if ($request->filled('date_from')) {
            $query->whereDate('created_at', '>=', (string) $request->string('date_from'));
        }

        if ($request->filled('date_to')) {
            $query->whereDate('created_at', '<=', (string) $request->string('date_to'));
        }

        return $query;
    }
}
