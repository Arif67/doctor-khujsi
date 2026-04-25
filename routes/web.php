<?php

use App\Http\Controllers\Admin\AppointmentController;
use App\Http\Controllers\Admin\AppSettingsController;
use App\Http\Controllers\Admin\AttentionController;
use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DepartmentController;
use App\Http\Controllers\Admin\DoctorBookingController;
use App\Http\Controllers\Admin\DoctorController;
use App\Http\Controllers\Admin\PagesController;
use App\Http\Controllers\Admin\PagesSectionUpdateController;
use App\Http\Controllers\Admin\PatientController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\SupportMessageController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Frontend\FrontendController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\AuthenticateRedirectController;
use App\Http\Controllers\Patient\DefaultController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DefaultController as SiteDefaultController;
use Illuminate\Support\Facades\Artisan;

// Frontend Controller Routes
Route::controller(FrontendController::class)
->name('app.')
->group(function () {
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
    Route::get('/service-history/{service}/{title}', 'serviceHistory')->name('service.history');
    
    // Doctor profile (public route)
    Route::get('/doctor-profile/{doctor}/{name}', 'doctorProfile')->name('doctor-profile');
    
    // Service info page
    Route::get('/service-info', 'serviceInfo')->name('serviceinfo');
    
    // Blog info page
    Route::get('/blog/{blog}/{slug}', 'blogInfo')->name('blog.info');
});

Route::post('/contact-message', [SiteDefaultController::class, 'contactMessageStore'])->name('app.contact.msg.store');
// Patient Route
Route::prefix('patient')
->name('patient.')
->middleware(['auth', 'role:patient']) 
->group(function(){
    Route::get( 'dashboard',[DefaultController::class,'dashboard'])->name('dashboard');
    Route::get('profile',[DefaultController::class,'profile'])->name('profile');
    Route::put('profile-update',[DefaultController::class,'profileUpdate'])->name('profile.update');
    Route::get('/appointments', [DefaultController::class,'appointments'])->name('appointments');
    Route::get('/favorite-doctor', [DefaultController::class,'favoriteDoctor'])->name('favorite.doctor');
    Route::get('/service-history', [DefaultController::class,'serviceHistory'])->name('service.history');

    Route::post('favorite-doctore/{id}',[DefaultController::class,'favoriteDcotore'])->name('favorite.doctore');
});

// Clear Cache Route
Route::get('/clear', function() {
    Artisan::call('config:clear');
    Artisan::call('cache:clear');
    Artisan::call('view:clear');
    Artisan::call('route:clear');
    return redirect('/');
});

// Auth Redirect Route
Route::get('auth/redirect',[AuthenticateRedirectController::class,'handleAuthRedirect'])->name('auth.redirect');
Route::get('/dashboard', fn () => redirect()->route('auth.redirect'))->middleware('auth')->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile');
    Route::patch('/profile', [ProfileController::class, 'update']);
    Route::delete('/profile', [ProfileController::class, 'destroy']);
});

// Admin Dashboard Route
Route::prefix('admin')
    ->name('admin.')
    ->middleware(['auth', 'role:admin|hospital_owner'])
    ->group(function () {
        Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
        Route::resource('doctors', DoctorController::class);
        Route::get('doctor-analytics', [DoctorBookingController::class, 'analytics'])->name('doctor-bookings.analytics');
        Route::get('doctor-bookings', [DoctorBookingController::class, 'index'])->name('doctor-bookings.index');
        Route::get('doctor-bookings/{doctorBooking}', [DoctorBookingController::class, 'show'])->name('doctor-bookings.show');
        Route::get('doctor-bookings-export', [DoctorBookingController::class, 'export'])->name('doctor-bookings.export');
        Route::get('doctor-bookings-print', [DoctorBookingController::class, 'print'])->name('doctor-bookings.print');
        Route::get('doctor-bookings-summary', [DoctorBookingController::class, 'summary'])->name('doctor-bookings.summary');
        Route::patch('doctor-bookings/{doctorBooking}/notes', [DoctorBookingController::class, 'updateNotes'])->name('doctor-bookings.update-notes');
        Route::patch('doctor-bookings/{doctorBooking}/status', [DoctorBookingController::class, 'updateStatus'])->name('doctor-bookings.update-status');
        Route::get('support', [SupportMessageController::class, 'index'])->name('support.index');
        Route::post('support', [SupportMessageController::class, 'store'])->name('support.store');
        Route::patch('support/{supportMessage}/reply', [SupportMessageController::class, 'reply'])->name('support.reply');

        Route::middleware('role:admin')->group(function () {
            Route::resource('roles', RoleController::class);
            Route::resource('permissions', PermissionController::class);
            Route::resource('users', UserController::class);
            Route::patch('/users/{user}/approve-hospital', [UserController::class, 'approveHospital'])->name('users.approve-hospital');
            Route::patch('/users/{user}/reject-hospital', [UserController::class, 'rejectHospital'])->name('users.reject-hospital');

            Route::get('/users/{id}/profile', [UserController::class, 'profile'])->name('users.profile');
            Route::put('/users/{id}/profile_update', [UserController::class, 'profileUpdate'])->name('users.profile.update');
            
            Route::prefix('app/pages')
            ->name('app.')
            ->group(function(){
                Route::get('/home',[PagesController::class,'PagesHome'])->name('pages.home');
            });

            Route::get('app/settings',[AppSettingsController::class,'edit'])->name('app.setting.edit');
            Route::put('app/settings/update',[AppSettingsController::class,'update'])->name('app.setting.update');

            Route::prefix('app/section')
            ->name('sections.')
            ->group(function(){
                Route::put('home_hero',[PagesSectionUpdateController::class,'home_hero'])->name('home.hero.update');
                Route::put('home_freture',[PagesSectionUpdateController::class,'home_feature'])->name('home.feature.update');
                Route::put('home_about_us',[PagesSectionUpdateController::class,'home_about_us'])->name('home.about_us.update');
            });

            Route::resource('patients', PatientController::class);
            Route::resource('services', ServiceController::class);
            Route::resource('attentions', AttentionController::class);
            Route::resource('categories', CategoryController::class);
            Route::resource('blogs', BlogController::class);
            Route::resource('departments', DepartmentController::class);
            Route::get('contact-messages', [AppSettingsController::class, 'contactMessages'])->name('contact.messages');

            Route::get('appointments',[AppointmentController::class,'index'])->name('appointments.index');
            Route::get('appointment-assign/{id}',[AppointmentController::class,'appointmentsAssign'])->name('appointments.assign');
            Route::post('/appointments/{appointment}/assign', [AppointmentController::class, 'assignService'])
            ->name('appointments.assignService');
            Route::get('patient-profile/{id}',[AppointmentController::class,'patientProfile'])->name('patient.profile');
        });
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
