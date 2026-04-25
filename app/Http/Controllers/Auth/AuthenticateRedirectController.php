<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthenticateRedirectController extends Controller
{
    public function handleAuthRedirect()
    {
        if (Auth::check()) {
            $user = Auth::user();
            if ($user->hasRole('admin')) {
                return redirect()->route('admin.dashboard');
            } elseif ($user->hasRole('hospital_owner')) {
                return redirect()->route('admin.dashboard');
            } elseif ($user->hasRole('doctor')) {
                return redirect()->route('doctor.dashboard');
            } elseif ($user->hasRole('patient')) {
                return redirect()->route('patient.dashboard');
            } else {
                Auth::logout();
                return redirect()->route('app.signin')->with('error', 'Unauthorized access.');
            }
        } else {
            return redirect()->route('app.signin')->with('error', 'Please log in to continue.');
        }
    }
}
