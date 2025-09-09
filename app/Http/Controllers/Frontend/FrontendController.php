<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Attention;
use App\Models\Blog;
use App\Models\Category;
use App\Models\Doctor;
use App\Models\Service;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    public function home()
    {
        $services = Service::latest()->get();
        $attentions = Attention::latest()->get();
        $doctores = Doctor::latest()->with('department')->get();
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
        return view('frontend.pages.booking');
    }

    public function storeBooking(Request $request)
    {
        return redirect()->back()->with('success', 'Booking request submitted successfully!');
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
        return view('frontend.pages.specialists');
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
