<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use Spatie\Permission\Models\Role;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        if ($request->filled('name') && !$request->filled('hospital_name')) {
            $validated = $request->validate([
                'name' => ['required', 'string', 'max:100'],
                'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
                'password' => ['required', 'confirmed', Rules\Password::defaults()],
            ]);

            $user = User::create([
                'name' => $validated['name'],
                'email' => $validated['email'],
                'plan_password' => $validated['password'],
                'password' => Hash::make($validated['password']),
            ]);

            event(new Registered($user));

            Auth::login($user);

            return redirect(route('dashboard', absolute: false));
        }

        $validated = $request->validate([
            'hospital_name' => ['required', 'string', 'max:150'],
            'hospital_location' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'string', 'max:20'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'owner_name' => ['required', 'string', 'max:100'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'terms' => ['accepted'],
        ]);

        $user = User::create([
            'first_name' => $validated['owner_name'],
            'last_name' => null,
            'hospital_name' => $validated['hospital_name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'],
            'hospital_location' => $validated['hospital_location'],
            'address' => $validated['hospital_location'],
            'plan_password' => $validated['password'],
            'password' => Hash::make($validated['password']),
            'approval_status' => 'pending',
        ]);

        $hospitalOwnerRole = Role::findOrCreate('hospital_owner', 'web');

        $user->assignRole($hospitalOwnerRole);

        event(new Registered($user));

        return redirect()
            ->route('login')
            ->with('status', 'Registration submitted. You can log in after super admin approval.');
    }
}
