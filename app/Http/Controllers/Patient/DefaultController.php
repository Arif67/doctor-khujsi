<?php

namespace App\Http\Controllers\Patient;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DefaultController extends Controller
{
    public function dashboard(){
        return view('patients.dashboard');
    }
    public function profile(){
        return view('patients.profile');
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
        return view('patients.favorite_doctore');
    }

    /**
     * Display the user's service history
     */
    public function serviceHistory()
    {
        return view('patients.service_history');
    }
}
