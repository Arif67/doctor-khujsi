<?php

namespace App\Http\Controllers\Patient;

use App\Http\Controllers\Controller;
use App\Models\Favorite;
use App\Models\ServiceHistory;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;

class DefaultController extends Controller
{
    public function dashboard(Request $request){
        $user = Auth::user();
        $count = [
            'appointments' => $user->appointments()->count(),
            'favorites'    => $user->favorites()->count(),
            'serviceHistoryCount' => $user->serviceHistoryCount()
        ];

       $items = ServiceHistory::with(['service','doctor'])
                ->where('patient_id', Auth::id())
                ->whereDate('created_at', Carbon::today())
                ->latest()->get();

        // Blade view
        return view('patients.dashboard', compact('count','items'));
    }
    public function profile(){
        $user = Auth::user();
        return view('patients.profile',compact('user'));
    }

    /**
     * Display the user's appointments
     */
    public function appointments()
    {
        return view('patients.appointments');
    }

    /**
     * Display the user's favorite doctors
     */
    public function favoriteDoctor()
    {
        $user = Auth::user();

        $items = Favorite::where('patient_id',$user->id)->with('doctor')->get();
        return view('patients.favorite_doctore',compact('items'));
    }

    /**
     * Display the user's service history
     */
    public function serviceHistory()
    {
        return view('patients.service_history');
    }

    public function favoriteDcotore(int $doctorId){
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
    public function profileUpdate(Request $request){
        $user = Auth::user();

        if (!$user) {
            return redirect()->back()->with('error', 'Patient Not Found.');
        }
        // Validation
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'nullable|email|max:255|unique:users,email,'.$user->id,
            'phone' => 'nullable|string|max:20',
            'mobile' => 'nullable|string|max:20',
            'gender' => 'nullable|in:Male,Female,Other',
            'age' => 'nullable|string',
            'date_of_birth' => 'nullable|date',
            'address' => 'nullable|string|max:500',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Update basic info
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->mobile = $request->mobile;
        $user->gender = $request->gender;
        $user->age = $request->age;
        $user->date_of_birth = $request->date_of_birth;
        $user->address = $request->address;

        // Handle Photo Upload
        if ($request->hasFile('photo')) {
            // Delete old photo if exists
            if ($user->photo && Storage::exists('public/'.$user->photo)) {
                Storage::delete('public/'.$user->photo);
            }
            // Store new photo
            $path = $request->file('photo')->store('patients', 'public');
            $user->photo = $path;
        }

        $user->save();

        return redirect()->back()->with('success', 'Profile updated successfully.');
    }
}
