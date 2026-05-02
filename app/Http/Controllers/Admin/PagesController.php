<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Doctor;
use App\Models\Service;
use App\Models\Section;
use App\Models\User;
use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function PagesHome()  {
        $heroData = Section::where('key','home_hero')->first() ?? [];
        $heroSliderData = Section::where('key', 'home_hero_slider')->first();
        $featureData = Section::where('key', 'home_feature')->first();
        $aboutUsData   = Section::where('key', 'home_about_us')->first();
        $featuredHospitalsData = Section::where('key', 'home_featured_hospitals')->first();
        $featuredDoctorsData = Section::where('key', 'home_featured_doctors')->first();
        $homeServicesData = Section::where('key', 'home_services')->first();
        $hospitalOwners = User::query()
            ->role('hospital_owner')
            ->where('approval_status', 'approved')
            ->orderByRaw('COALESCE(NULLIF(hospital_name, ""), CONCAT(first_name, " ", COALESCE(last_name, ""))) asc')
            ->get(['id', 'hospital_name', 'first_name', 'last_name', 'hospital_location', 'photo']);
        $services = Service::query()
            ->with('owner')
            ->whereHas('owner', fn ($query) => $query->role('hospital_owner')->where('approval_status', 'approved'))
            ->latest()
            ->get();
        $doctors = Doctor::query()
            ->with(['department', 'owner'])
            ->where('status', 'active')
            ->whereHas('owner', fn ($query) => $query->role('hospital_owner')->where('approval_status', 'approved'))
            ->latest()
            ->get();

       
        return view('admin.app.pages.home', compact('heroData', 'heroSliderData', 'featureData', 'aboutUsData', 'featuredHospitalsData', 'featuredDoctorsData', 'homeServicesData', 'hospitalOwners', 'services', 'doctors'));
    }
}
