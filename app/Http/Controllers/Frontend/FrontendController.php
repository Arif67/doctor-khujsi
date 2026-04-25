<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\PublicDoctorBookingRequest;
use App\Models\Attention;
use App\Models\Blog;
use App\Models\Category;
use App\Models\Doctor;
use App\Models\DoctorBooking;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class FrontendController extends Controller
{
    public function home()
    {
        $services = Service::latest()->get();
        $attentions = Attention::latest()->get();
        $featuredDoctors = Doctor::query()
            ->with(['department', 'owner'])
            ->where('status', 'active')
            ->where('show_on_homepage', true)
            ->latest()
            ->take(10)
            ->get();
        $doctores = $featuredDoctors->isNotEmpty()
            ? $featuredDoctors
            : Doctor::query()
                ->with(['department', 'owner'])
                ->where('status', 'active')
                ->latest()
                ->take(10)
                ->get();
        $blogs = Blog::latest()->get();
        return view('home',compact('services','attentions','doctores','blogs'));
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

        return view('frontend.pages.booking', [
            'doctors' => $doctors,
            'selectedDoctor' => $doctors->firstWhere('id', request('doctor')),
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
         $services = Service::latest()->get();
        return view('frontend.pages.services',compact('services'));
    }

    public function specialists()
    {
        $doctores = Doctor::query()
            ->with(['department', 'owner'])
            ->where('status', 'active')
            ->latest()
            ->get();

        return view('frontend.pages.specialists', compact('doctores'));
    }

    public function doctorProfile(Doctor $doctor,$name)
    {
        return view('frontend.pages.doctor_profile', compact('doctor'));
    }
    
    public function serviceHistory(Service $service,$title)
    {

        $services = Service::latest()->get();
        return view('frontend.pages.service-info',compact('service','services'));
    }
    
    public function blog()
    {
        $blogs = Blog::latest()->get();
        return view('frontend.pages.blog',compact('blogs'));
    }
    
    public function blogInfo(Blog $blog, $slug)
    {

        // Related blogs (same category, excluding current)
        $relatedBlogs = Blog::where('category_id', $blog->category_id)
                            ->where('id', '!=', $blog->id)
                            ->latest()
                            ->take(3)
                            ->get();

        // Sidebar: all categories
        $categories = Category::latest()->get();

        // Sidebar: recent blogs (latest 5, excluding current)
        $recentBlogs = Blog::where('id', '!=', $blog->id)
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
