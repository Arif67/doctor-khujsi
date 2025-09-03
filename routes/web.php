<?php

use App\Http\Controllers\Admin\AppSettingsController;
use App\Http\Controllers\Admin\AttentionController;
use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DepartmentController;
use App\Http\Controllers\Admin\DoctorController;
use App\Http\Controllers\Admin\PagesController;
use App\Http\Controllers\Admin\PagesSectionUpdateController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Frontend\FrontendController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Patient\DefaultController;
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
    Route::get('/service-history', 'serviceHistory')->name('service-history');
    
    // Doctor profile (public route)
    Route::get('/doctor-profile/{id}', 'doctorProfile')->name('doctor-profile');
    
    // Service info page
    Route::get('/service-info', 'serviceInfo')->name('serviceinfo');
    
    // Blog info page
    Route::get('/blog/{slug}', 'blogInfo')->name('bloginfo');
});

// Patient Route
Route::prefix('patient')
->name('patient.')
->group(function(){
    Route::get( 'dashboard',[DefaultController::class,'dashboard'])->name('dashboard');
    Route::get('profile',[DefaultController::class,'profile'])->name('profile');

    Route::get('/appointments', [DefaultController::class,'appointments'])->name('appointments');
    Route::get('/favorite-doctor', [DefaultController::class,'favoriteDoctor'])->name('favorite.doctor');
    Route::get('/service-history', [DefaultController::class,'serviceHistory'])->name('service.history');
});


Route::get('/clear', function() {
    Artisan::call('config:clear');
    Artisan::call('cache:clear');
    Artisan::call('view:clear');
    Artisan::call('route:clear');
    return redirect('/');
});

// Admin Dashboard Route
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



        Route::resource('services', ServiceController::class);
        Route::resource('attentions', AttentionController::class);
        Route::resource('categories', CategoryController::class);
        Route::resource('blogs', BlogController::class);
        Route::resource('departments', DepartmentController::class);
        Route::resource('doctors', DoctorController::class);
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
