<?php

use App\Http\Controllers\Admin\AppSettings;
use App\Http\Controllers\Admin\AttentionController;
use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DepartmentController;
use App\Http\Controllers\Admin\DoctorController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Profile\ProfileController;
use App\Http\Controllers\Frontend\FrontendController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AdminController;

// Frontend Controller Routes
Route::controller(FrontendController::class)->group(function () {
    // Home page
    Route::get('/', 'home')->name('home');
    Route::get('/home', 'home');
    
    // Main pages
    Route::get('/about', 'about')->name('about');
    Route::get('/contact', 'contact')->name('contact');
    Route::get('/services', 'services')->name('services');
    Route::get('/specialists', 'specialists')->name('specialists');
    Route::get('/shop', 'shop')->name('shop');
    Route::get('/blog', 'blog')->name('blog');
    
    // Authentication pages
    Route::get('/signin', 'signin')->name('signin');
    Route::get('/register-page', 'register')->name('register.page');
    
    // Appointment and booking
    Route::get('/appointment', 'booking')->name('appointment');
    Route::get('/booking', 'booking')->name('booking');
    Route::post('/booking', 'storeBooking')->name('booking.store');
    
    // Favorite doctors (public route)
    Route::get('/favorite', 'favorite')->name('favorite');
    
    // Service history (public route)
    Route::get('/service-history', 'serviceHistory')->name('service-history');
    
    // Doctor profile (public route)
    Route::get('/doctor-profile/{id}', 'doctorProfile')->name('doctor-profile');
    
    // Service info page
    Route::get('/service-info', 'serviceInfo')->name('serviceinfo');
    
    // Blog info page
    Route::get('/blog/{slug}', 'blogInfo')->name('bloginfo');
});


Route::prefix('admin')
    ->name('admin.')
    ->group(function () {
        Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
        Route::resource('roles', RoleController::class);
        Route::resource('permissions', PermissionController::class);
        Route::resource('users', UserController::class);

        Route::get('/users/{id}/profile', [UserController::class, 'profile'])->name('users.profile');
        Route::put('/users/{id}/profile_update', [UserController::class, 'profileUpdate'])->name('users.profile.update');
        
        Route::prefix('app/pages')
        ->name('app.')
        ->group(function(){
            Route::get('/',[AppSettings::class,'PagesIndex'])->name('pages.index');
            Route::get('/home',[AppSettings::class,'PagesHome'])->name('pages.home');
        });
        Route::resource('services', ServiceController::class);
        Route::resource('attentions', AttentionController::class);
        Route::resource('categories', CategoryController::class);
        Route::resource('blogs', BlogController::class);
        Route::resource('departments', DepartmentController::class);
         Route::resource('doctors', DoctorController::class);
    });


    // Admin Dashboard Route

    // Profile Routes (Authenticated)
    Route::middleware('auth')->controller(ProfileController::class)->group(function () {
        // Main profile route - using edit as the main profile page
        Route::get('/profile', 'edit')->name('profile');
        
        // Profile update and delete routes
        Route::patch('/profile', 'update')->name('profile.update');
        Route::delete('/profile', 'destroy')->name('profile.destroy');
        
        // Profile sections
        Route::get('/profile/appointments', 'appointments')->name('profile.appointments');
        Route::get('/profile/favorite', 'favorite')->name('profile.favorite');
        Route::get('/profile/service-history', 'serviceHistory')->name('profile.service-history');
    });

// Logout route
Route::post('/logout', function () {
    Auth::guard('web')->logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();
    return redirect('/');
})->middleware('auth')->name('logout');

// Include Laravel's built-in auth routes
require __DIR__.'/auth.php';
