<?php

namespace App\Http\Controllers\Patient;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\Favorite;
use App\Models\ServiceHistory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class DefaultController extends Controller
{
    public function dashboard()
    {
        $user = Auth::user();

        $upcomingAppointmentsCount = $user->appointments()
            ->whereDate('appointment_date', '>=', now()->toDateString())
            ->count();

        $completedServicesCount = $user->serviceHistory()
            ->whereRaw('LOWER(status) = ?', ['done'])
            ->count();

        $pendingServicesCount = $user->serviceHistory()
            ->whereRaw('LOWER(status) IN (?, ?)', ['pending', 'panding'])
            ->count();

        $profileFields = [
            $user->first_name,
            $user->last_name,
            $user->email,
            $user->phone ?: $user->mobile,
            $user->blood,
            $user->gender,
            $user->date_of_birth,
            $user->address,
        ];

        $profileCompletion = (int) round(
            collect($profileFields)->filter(fn ($value) => filled($value))->count() / count($profileFields) * 100
        );

        $count = [
            'appointments' => $user->appointments()->count(),
            'favorites'    => $user->favorites()->count(),
            'serviceHistoryCount' => $user->serviceHistoryCount(),
            'reports' => $user->patientReports()->count(),
            'prescriptions' => $user->patientPrescriptions()->count(),
            'upcomingAppointments' => $upcomingAppointmentsCount,
            'completedServices' => $completedServicesCount,
            'pendingServices' => $pendingServicesCount,
            'profileCompletion' => $profileCompletion,
        ];

        $recentServices = $user->serviceHistory()
            ->with(['service', 'doctor'])
            ->latest('service_date')
            ->latest()
            ->take(5)
            ->get();

        $recentReports = $user->patientReports()
            ->latest('report_date')
            ->latest()
            ->take(5)
            ->get();

        $recentPrescriptions = $user->patientPrescriptions()
            ->latest('prescription_date')
            ->latest()
            ->take(5)
            ->get();

        $appointments = $user->appointments()
            ->with(['department', 'serviceHistory.service', 'serviceHistory.doctor'])
            ->latest('appointment_date')
            ->latest()
            ->take(5)
            ->get();

        return view('patients.dashboard', compact('count', 'recentServices', 'recentReports', 'recentPrescriptions', 'appointments'));
    }

    public function profile()
    {
        $user = Auth::user();

        $profileItems = collect([
            __('Photo') => $user->photo,
            __('First name') => $user->first_name,
            __('Last name') => $user->last_name,
            __('Email') => $user->email,
            __('Phone or mobile') => $user->phone ?: $user->mobile,
            __('Blood group') => $user->blood,
            __('Gender') => $user->gender,
            __('Date of birth') => $user->date_of_birth,
            __('Address') => $user->address,
        ]);

        $profileStats = [
            'appointments' => $user->appointments()->count(),
            'reports' => $user->patientReports()->count(),
            'prescriptions' => $user->patientPrescriptions()->count(),
            'favorites' => $user->favorites()->count(),
            'completion' => (int) round($profileItems->filter(fn ($value) => filled($value))->count() / $profileItems->count() * 100),
        ];
        $recentReports = $user->patientReports()
            ->latest('report_date')
            ->latest()
            ->take(3)
            ->get();

        $missingProfileItems = $profileItems
            ->filter(fn ($value) => blank($value))
            ->keys()
            ->values();

        return view('patients.profile', compact('user', 'profileStats', 'recentReports', 'missingProfileItems'));
    }

    public function appointments()
    {
        $appointments = Appointment::query()
            ->where('patient_id', Auth::id())
            ->with(['department', 'serviceHistory.service', 'serviceHistory.doctor'])
            ->latest('appointment_date')
            ->latest()
            ->get();

        return view('patients.appointments', compact('appointments'));
    }

    public function favoriteDoctor()
    {
        $items = Favorite::query()
            ->where('patient_id', Auth::id())
            ->with(['doctor.department', 'doctor.owner'])
            ->latest()
            ->get();

        return view('patients.favorite_doctore', compact('items'));
    }

    public function serviceHistory()
    {
        $items = ServiceHistory::query()
            ->where('patient_id', Auth::id())
            ->with(['service', 'doctor'])
            ->latest('service_date')
            ->latest()
            ->get();

        return view('patients.service_history', compact('items'));
    }

    public function timeline()
    {
        $user = Auth::user();

        $appointments = $user->appointments()
            ->with(['department', 'serviceHistory.service', 'serviceHistory.doctor'])
            ->get()
            ->map(function ($appointment) {
                return [
                    'type' => 'appointment',
                    'date' => $appointment->appointment_date ?? $appointment->created_at,
                    'title' => __('Appointment booked'),
                    'subtitle' => $appointment->department?->name ?? __('Department not assigned'),
                    'meta' => [
                        __('Appointment ID') => $appointment->appointment_id,
                        __('Schedule') => trim(collect([
                            optional($appointment->appointment_date)->format('d M Y'),
                            $appointment->appointment_time,
                        ])->filter()->join(' • ')) ?: __('N/A'),
                        __('Status') => ucfirst((string) $appointment->status),
                    ],
                ];
            });

        $reports = $user->patientReports()
            ->get()
            ->map(function ($report) {
                return [
                    'type' => 'report',
                    'date' => $report->report_date ?? $report->created_at,
                    'title' => __('Report uploaded'),
                    'subtitle' => $report->title,
                    'meta' => [
                        __('Report Type') => $report->report_type ?: __('General report'),
                        __('File') => $report->file_name,
                    ],
                ];
            });

        $services = $user->serviceHistory()
            ->with(['service', 'doctor'])
            ->get()
            ->map(function ($item) {
                return [
                    'type' => 'service',
                    'date' => $item->service_date ?? $item->created_at,
                    'title' => __('Service update'),
                    'subtitle' => $item->service?->title ?? __('N/A'),
                    'meta' => [
                        __('Doctor') => $item->doctor?->name ?? __('N/A'),
                        __('Time') => $item->service_time ?: $item->created_at->format('h:i A'),
                        __('Status') => ucfirst((string) $item->status),
                    ],
                ];
            });

        $timelineItems = $appointments
            ->concat($reports)
            ->concat($services)
            ->sortByDesc(fn ($item) => optional($item['date'])->timestamp ?? 0)
            ->values();

        $timelineCounts = [
            'all' => $timelineItems->count(),
            'appointments' => $appointments->count(),
            'reports' => $reports->count(),
            'services' => $services->count(),
        ];

        return view('patients.timeline', compact('timelineItems', 'timelineCounts'));
    }

    public function favoriteDcotore(int $doctorId)
    {
        $patientId = Auth::id();
        $favorite = Favorite::where('patient_id', $patientId)
                        ->where('doctor_id', $doctorId)
                        ->first();
         if ($favorite) {
            $favorite->delete();
            return response()->json(['status' => 'removed']);
        } else {
            Favorite::create([
                'patient_id' => $patientId,
                'doctor_id' => $doctorId,
            ]);
            return response()->json(['status' => 'added']);
        }
    }

    public function profileUpdate(Request $request)
    {
        $user = Auth::user();

        if (!$user) {
            return redirect()->back()->with('error', __('Patient not found.'));
        }

        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'nullable|email|max:255|unique:users,email,'.$user->id,
            'phone' => 'nullable|string|max:20',
            'mobile' => 'nullable|string|max:20',
            'blood' => 'nullable|string|max:10',
            'gender' => 'nullable|in:Male,Female,Other',
            'age' => 'nullable|string',
            'date_of_birth' => 'nullable|date',
            'address' => 'nullable|string|max:500',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ], [
            'first_name.required' => __('First name is required.'),
            'first_name.max' => __('First name may not be greater than :max characters.', ['max' => 255]),
            'last_name.required' => __('Last name is required.'),
            'last_name.max' => __('Last name may not be greater than :max characters.', ['max' => 255]),
            'email.email' => __('Please enter a valid email address.'),
            'email.max' => __('Email may not be greater than :max characters.', ['max' => 255]),
            'email.unique' => __('This email address is already in use.'),
            'phone.max' => __('Phone may not be greater than :max characters.', ['max' => 20]),
            'mobile.max' => __('Mobile may not be greater than :max characters.', ['max' => 20]),
            'blood.max' => __('Blood group may not be greater than :max characters.', ['max' => 10]),
            'gender.in' => __('Please select a valid gender.'),
            'date_of_birth.date' => __('Please enter a valid date of birth.'),
            'address.max' => __('Address may not be greater than :max characters.', ['max' => 500]),
            'photo.image' => __('Photo must be an image file.'),
            'photo.mimes' => __('Photo must be a file of type: :values.', ['values' => 'jpeg, png, jpg, gif']),
            'photo.max' => __('Photo may not be greater than :max kilobytes.', ['max' => 2048]),
        ], [
            'first_name' => __('First Name'),
            'last_name' => __('Last Name'),
            'email' => __('Email'),
            'phone' => __('Phone'),
            'mobile' => __('Mobile'),
            'blood' => __('Blood Group'),
            'gender' => __('Gender'),
            'date_of_birth' => __('Date of Birth'),
            'address' => __('Address'),
            'photo' => __('Photo'),
        ]);

        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->mobile = $request->mobile;
        $user->blood = $request->blood;
        $user->gender = $request->gender;
        $user->age = $request->age;
        $user->date_of_birth = $request->date_of_birth;
        $user->address = $request->address;

        if ($request->hasFile('photo')) {
            if ($user->photo && Storage::disk('public')->exists($user->photo)) {
                Storage::disk('public')->delete($user->photo);
            }

            $path = $request->file('photo')->store('patients', 'public');
            $user->photo = $path;
        }

        $user->save();

        return redirect()->back()->with('success', __('Profile updated successfully.'));
    }
}
