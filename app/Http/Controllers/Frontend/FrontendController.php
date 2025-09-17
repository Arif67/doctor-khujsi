<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\Attention;
use App\Models\Blog;
use App\Models\Category;
use App\Models\Department;
use App\Models\Doctor;
use App\Models\Service;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

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
        $departments = Department::latest()->get();
        return view('frontend.pages.booking',compact('departments'));
    }

    public function storeBooking(Request $request)
    {   

       // dd($request->all());
         $request->validate([
            'first_name'       => 'required|string|max:255',
            'last_name'        => 'required|string|max:255',
            'email'            => 'required|email',
            'phone'            => 'required|string',
            'blood'            => 'nullable|string|max:10',
            'sex'              => 'nullable|string|in:Male,Female',
            'date_of_birth'    => 'nullable|date',
            'password'         => 'required|min:6',
            'department_id'    => 'required|exists:departments,id',
            'appointment_date' => 'required|date',
            'appointment_time' => 'required',
            'message'          => 'nullable|string',
        ]);

         // Check if patient already exists by email
        $user = User::where('email', $request->email)->first();

        if (!$user) {
            $user = self::createUserFromRequest($request);
        }

         // Generate appointment ID (apt_0001 format)
        $lastAppointment = Appointment::latest('id')->first();
        $nextId = $lastAppointment ? $lastAppointment->id + 1 : 1;
        $appointmentId = 'apt_' . str_pad($nextId, 4, '0', STR_PAD_LEFT);

         // Create Appointment
        Appointment::create([
            'appointment_id'   => $appointmentId,
            'patient_id'       => $user->id,
            'department_id'    => $request->department_id,
            'appointment_date' => $request->appointment_date,
            'appointment_time' => $request->appointment_time,
            'message'          => $request->message,
        ]);

        return redirect()->back()->with('success', 'Booking request submitted successfully!');
    }

    private static function createUserFromRequest(Request $request){
        //dd($request->all());
        return User::create([
            'first_name'          => $request->first_name,
            'last_name'          => $request->last_name,
            'email'              => $request->email,
            'phone'              => $request->phone,
            'mobile'             => $request->mobile,
            'blood'              => $request->blood,
            'sex'                => $request->sex,
            'date_of_birth'      => $request->date_of_birth,
            'password'           => Hash::make($request->password),
            'plan_password'      =>$request->password,
        ]);
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
