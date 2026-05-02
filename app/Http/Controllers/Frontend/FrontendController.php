<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\PublicDoctorBookingRequest;
use App\Models\Attention;
use App\Models\Blog;
use App\Models\Category;
use App\Models\Department;
use App\Models\Doctor;
use App\Models\DoctorBooking;
use App\Models\HospitalReview;
use App\Models\HospitalGallery;
use App\Models\LocationArea;
use App\Models\LocationDistrict;
use App\Models\LocationThana;
use App\Models\Service;
use App\Models\Section;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Pagination\LengthAwarePaginator;

class FrontendController extends Controller
{
    public function home()
    {
        $heroSliderSection = Section::where('key', 'home_hero_slider')->first();
        $featuredHospitalsSection = Section::where('key', 'home_featured_hospitals')->first();
        $featuredDoctorsSection = Section::where('key', 'home_featured_doctors')->first();
        $homeServicesSection = Section::where('key', 'home_services')->first();
        $serviceIds = collect($homeServicesSection->data['service_ids'] ?? [])
            ->map(fn ($id) => (int) $id)
            ->filter()
            ->values();
        $serviceDisplayCount = max(1, min(24, (int) ($homeServicesSection->data['display_count'] ?? 6)));
        $servicesQuery = Service::query()
            ->with('owner')
            ->whereHas('owner', fn ($query) => $query->role('hospital_owner')->where('approval_status', 'approved'));

        if ($serviceIds->isNotEmpty()) {
            $services = $servicesQuery
                ->whereIn('id', $serviceIds)
                ->get()
                ->sortBy(fn ($service) => $serviceIds->search((int) $service->id))
                ->take($serviceDisplayCount)
                ->values();
        } else {
            $services = $servicesQuery
                ->latest()
                ->take($serviceDisplayCount)
                ->get();
        }
        $attentions = Attention::latest()->get();
        $doctorIds = collect($featuredDoctorsSection->data['doctor_ids'] ?? [])
            ->map(fn ($id) => (int) $id)
            ->filter()
            ->values();
        $doctorDisplayCount = max(1, min(24, (int) ($featuredDoctorsSection->data['display_count'] ?? 6)));
        $doctorsQuery = Doctor::query()
            ->with(['department', 'owner'])
            ->where('status', 'active')
            ->whereHas('owner', fn ($query) => $query->role('hospital_owner')->where('approval_status', 'approved'));

        if ($doctorIds->isNotEmpty()) {
            $doctores = $doctorsQuery
                ->whereIn('id', $doctorIds)
                ->get()
                ->sortBy(fn ($doctor) => $doctorIds->search((int) $doctor->id))
                ->take($doctorDisplayCount)
                ->values();
        } else {
            $featuredDoctors = (clone $doctorsQuery)
                ->where('show_on_homepage', true)
                ->latest()
                ->take($doctorDisplayCount)
                ->get();

            $doctores = $featuredDoctors->isNotEmpty()
                ? $featuredDoctors
                : $doctorsQuery
                    ->latest()
                    ->take($doctorDisplayCount)
                    ->get();
        }
        $blogs = Blog::latest()->get();
        $heroSlides = collect($heroSliderSection->data['slides'] ?? [])
            ->filter(fn ($slide) => filled($slide['title'] ?? null) || filled($slide['heading'] ?? null) || filled($slide['photo'] ?? null))
            ->values();
        $featuredHospitalIds = collect($featuredHospitalsSection->data['hospital_ids'] ?? [])
            ->map(fn ($id) => (int) $id)
            ->filter()
            ->take(10)
            ->values();
        $featuredHospitals = collect();

        if ($featuredHospitalIds->isNotEmpty()) {
            $featuredHospitals = User::query()
                ->role('hospital_owner')
                ->where('approval_status', 'approved')
                ->whereIn('id', $featuredHospitalIds)
                ->with(['doctors:id,owner_id,department_id'])
                ->withCount(['doctors', 'services', 'hospitalGalleries'])
                ->get()
                ->sortBy(fn ($hospital) => $featuredHospitalIds->search((int) $hospital->id))
                ->values()
                ->map(function ($hospital) {
                    $hospital->departments_count = $hospital->doctors
                        ->pluck('department_id')
                        ->filter()
                        ->unique()
                        ->count();

                    return $hospital;
                });
        }

        return view('home',compact('services','attentions','doctores','blogs', 'heroSlides', 'featuredHospitalsSection', 'featuredDoctorsSection', 'featuredHospitals', 'homeServicesSection'));
    }

    public function about()
    {
         $doctores = Doctor::latest()->with('department')->get();
        return view('frontend.pages.about',compact('doctores'));
    }

    public function booking()
    {
        $doctors = Doctor::query()
            ->with(['department', 'owner'])
            ->where('status', 'active')
            ->latest()
            ->get();

        $selectedDoctor = $doctors->firstWhere('id', request('doctor'));
        $selectedDepartment = null;

        if (request()->filled('department')) {
            $departmentId = request()->integer('department');
            $selectedDepartment = Department::query()->find($departmentId);

            if (! $selectedDoctor && $selectedDepartment) {
                $selectedDoctor = $doctors->firstWhere('department_id', $selectedDepartment->id);
            }
        }

        return view('frontend.pages.booking', [
            'doctors' => $doctors,
            'selectedDoctor' => $selectedDoctor,
            'selectedDepartment' => $selectedDepartment,
        ]);
    }

    public function storeBooking(PublicDoctorBookingRequest $request)
    {
        $doctor = Doctor::with('owner')->findOrFail($request->integer('doctor_id'));

        $booking = DoctorBooking::create([
            'doctor_id' => $doctor->id,
            'hospital_owner_id' => $doctor->owner_id,
            'patient_name' => $request->string('patient_name'),
            'patient_phone' => $request->string('patient_phone'),
            'patient_email' => $request->input('patient_email'),
            'patient_age' => $request->integer('patient_age'),
            'notes' => $request->input('notes'),
        ]);

        if ($doctor->owner?->email) {
            Mail::raw(
                "A new doctor booking has been submitted.\n\nPatient: {$booking->patient_name}\nPhone: {$booking->patient_phone}\nAge: {$booking->patient_age}\nDoctor: {$doctor->name}\nNotes: ".($booking->notes ?: 'N/A'),
                function ($message) use ($doctor) {
                    $message->to($doctor->owner->email)->subject('New doctor booking request');
                }
            );
        }

        return redirect()
            ->route('app.booking', ['doctor' => $doctor->id])
            ->with('success', 'Booking request submitted successfully.');
    }

    public function contact()
    {
        return view('frontend.pages.contact');
    }

    public function signin()
    {
        return view('frontend.pages.signin');
    }

    public function register()
    {
        return view('frontend.pages.register');
    }

    public function services()
    {
         $services = Service::query()
             ->with('owner')
             ->whereHas('owner', fn ($query) => $query->role('hospital_owner')->where('approval_status', 'approved'))
             ->latest()
             ->get();
        return view('frontend.pages.services',compact('services'));
    }

    public function hospitals()
    {
        $filters = request()->only(['search', 'district_id', 'thana_id', 'area_id', 'sort']);

        $query = User::query()
            ->role('hospital_owner')
            ->where('approval_status', 'approved')
            ->with(['doctors:id,owner_id,department_id'])
            ->withCount(['doctors', 'services', 'hospitalGalleries'])
            ->latest();

        if (request()->filled('search')) {
            $search = trim((string) request('search'));

            $query->where(function ($hospitalQuery) use ($search) {
                $hospitalQuery
                    ->where('hospital_name', 'like', '%' . $search . '%')
                    ->orWhere('name', 'like', '%' . $search . '%')
                    ->orWhere('hospital_location', 'like', '%' . $search . '%');
            });
        }

        $districtName = request()->filled('district_id')
            ? LocationDistrict::query()->whereKey(request()->integer('district_id'))->value('name')
            : null;
        $thanaName = request()->filled('thana_id')
            ? LocationThana::query()->whereKey(request()->integer('thana_id'))->value('name')
            : null;
        $areaName = request()->filled('area_id')
            ? LocationArea::query()->whereKey(request()->integer('area_id'))->value('name')
            : null;

        foreach ([
            'district' => $districtName,
            'thana' => $thanaName,
            'area' => $areaName,
        ] as $locationField => $locationName) {
            if ($locationName) {
                $query->where($locationField, $locationName);
            }
        }

        $hospitals = $query->get()->map(function ($hospital) {
            $hospital->departments_count = $hospital->doctors
                ->pluck('department_id')
                ->filter()
                ->unique()
                ->count();

            return $hospital;
        });

        $sort = $filters['sort'] ?? 'latest';

        $hospitals = match ($sort) {
            'doctors_desc' => $hospitals->sortByDesc('doctors_count')->values(),
            'services_desc' => $hospitals->sortByDesc('services_count')->values(),
            'departments_desc' => $hospitals->sortByDesc('departments_count')->values(),
            'name_asc' => $hospitals->sortBy(fn ($hospital) => mb_strtolower((string) $hospital->hospital_name))->values(),
            default => $hospitals->values(),
        };

        $perPage = 9;
        $currentPage = LengthAwarePaginator::resolveCurrentPage();
        $currentItems = $hospitals->slice(($currentPage - 1) * $perPage, $perPage)->values();
        $hospitals = new LengthAwarePaginator(
            $currentItems,
            $hospitals->count(),
            $perPage,
            $currentPage,
            [
                'path' => request()->url(),
                'query' => request()->query(),
            ]
        );

        $districts = LocationDistrict::query()->orderBy('name')->get(['id', 'name']);

        return view('frontend.pages.hospitals', compact('hospitals', 'districts', 'filters'));
    }

    public function hospitalDetails(User $hospital, string $slug)
    {
        abort_unless($hospital->hasRole('hospital_owner') && $hospital->approval_status === 'approved', 404);

        $hospital->load([
            'hospitalGalleries' => fn ($query) => $query->latest(),
            'services' => fn ($query) => $query->latest(),
            'doctors' => fn ($query) => $query->with('department')->where('status', 'active')->latest(),
            'hospitalReviews' => fn ($query) => $query->where('status', 'approved')->latest(),
        ])->loadCount([
            'services',
            'hospitalGalleries',
            'hospitalReviews as approved_hospital_reviews_count' => fn ($query) => $query->where('status', 'approved'),
            'doctors as active_doctors_count' => fn ($query) => $query->where('status', 'active'),
        ]);

        $departmentGroups = $hospital->doctors
            ->groupBy(fn ($doctor) => $doctor->department?->name ?: 'General')
            ->map(fn ($doctors, $name) => [
                'name' => $name,
                'department_id' => $doctors->first()?->department_id,
                'count' => $doctors->count(),
                'doctors' => $doctors,
            ])
            ->values();

        return view('frontend.pages.hospital_details', compact('hospital', 'departmentGroups'));
    }

    public function storeHospitalReview(Request $request, User $hospital, string $slug)
    {
        abort_unless($hospital->hasRole('hospital_owner') && $hospital->approval_status === 'approved', 404);

        $validated = $request->validate([
            'reviewer_name' => 'required|string|max:120',
            'reviewer_email' => 'nullable|email|max:190',
            'rating' => 'required|integer|min:1|max:5',
            'review' => 'required|string|min:12|max:1500',
        ]);

        HospitalReview::create([
            'hospital_owner_id' => $hospital->id,
            'reviewer_name' => $validated['reviewer_name'],
            'reviewer_email' => $validated['reviewer_email'] ?? null,
            'rating' => $validated['rating'],
            'review' => $validated['review'],
            'status' => 'pending',
        ]);

        return redirect()
            ->route('app.hospitals.show', ['hospital' => $hospital->id, 'slug' => $slug])
            ->with('success', 'Review submitted successfully. It will appear after admin approval.')
            ->withFragment('hospital-reviews');
    }

    public function specialists(Request $request)
    {
        $filters = $request->only(['department', 'district_id', 'thana_id', 'area_id']);

        $query = Doctor::query()
            ->with(['department', 'owner'])
            ->where('status', 'active')
            ->latest();

        if ($request->filled('department')) {
            $query->where('department_id', $request->integer('department'));
        }

        $districtName = $request->filled('district_id')
            ? LocationDistrict::query()->whereKey($request->integer('district_id'))->value('name')
            : null;
        $thanaName = $request->filled('thana_id')
            ? LocationThana::query()->whereKey($request->integer('thana_id'))->value('name')
            : null;
        $areaName = $request->filled('area_id')
            ? LocationArea::query()->whereKey($request->integer('area_id'))->value('name')
            : null;

        foreach ([
            'district' => $districtName,
            'thana' => $thanaName,
            'area' => $areaName,
        ] as $locationFilter => $locationName) {
            if (! $locationName) {
                continue;
            }

            $query->where(function ($doctorQuery) use ($locationName, $locationFilter) {
                $doctorQuery
                    ->where($locationFilter, $locationName)
                    ->orWhereHas('owner', function ($ownerQuery) use ($locationName, $locationFilter) {
                        $ownerQuery->where($locationFilter, $locationName);
                    });
            });
        }

        $doctores = $query->get();
        $departments = Department::query()->orderBy('name')->get();
        $districts = LocationDistrict::query()->orderBy('name')->get(['id', 'name']);

        return view('frontend.pages.specialists', compact('doctores', 'departments', 'filters', 'districts'));
    }

    public function doctorProfile(Doctor $doctor,$name)
    {
        return view('frontend.pages.doctor_profile', compact('doctor'));
    }
    
    public function serviceHistory(Service $service,$title)
    {
        if (! $service->owner || ! $service->owner->hasRole('hospital_owner') || $service->owner->approval_status !== 'approved') {
            abort(404);
        }

        $services = Service::query()
            ->with('owner')
            ->whereHas('owner', fn ($query) => $query->role('hospital_owner')->where('approval_status', 'approved'))
            ->latest()
            ->get();
        return view('frontend.pages.service-info',compact('service','services'));
    }
    
    public function blog()
    {
        $selectedCategoryId = request()->integer('category');
        $search = trim((string) request('search', ''));

        $blogQuery = Blog::query()
            ->with('category')
            ->latest();

        if ($selectedCategoryId) {
            $blogQuery->where('category_id', $selectedCategoryId);
        }

        if ($search !== '') {
            $blogQuery->where(function ($query) use ($search) {
                $query
                    ->where('title', 'like', '%' . $search . '%')
                    ->orWhere('short_description', 'like', '%' . $search . '%')
                    ->orWhere('content', 'like', '%' . $search . '%');
            });
        }

        $blogs = $blogQuery->get();
        $categories = Category::query()
            ->withCount('blogs')
            ->orderBy('name')
            ->get();

        return view('frontend.pages.blog', [
            'blogs' => $blogs,
            'categories' => $categories,
            'selectedCategoryId' => $selectedCategoryId,
            'search' => $search,
        ]);
    }
    
    public function blogInfo(Blog $blog, $slug)
    {
        $blog->load('category');

        // Related blogs (same category, excluding current)
        $relatedBlogs = Blog::where('category_id', $blog->category_id)
                            ->with('category')
                            ->where('id', '!=', $blog->id)
                            ->latest()
                            ->take(3)
                            ->get();

        // Sidebar: all categories
        $categories = Category::query()
            ->withCount('blogs')
            ->orderBy('name')
            ->get();

        // Sidebar: recent blogs (latest 5, excluding current)
        $recentBlogs = Blog::where('id', '!=', $blog->id)
                        ->with('category')
                        ->latest()
                        ->take(5)
                        ->get();

        return view('frontend.pages.bloginfo', [
            'blog' => $blog,
            'relatedBlogs' => $relatedBlogs,
            'categories' => $categories,
            'recentBlogs' => $recentBlogs
        ]);
    }
}
