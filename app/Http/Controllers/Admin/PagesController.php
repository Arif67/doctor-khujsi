<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Section;
use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function PagesHome()  {
        $heroData = Section::where('key','home_hero')->first() ?? [];
        $featureData = Section::where('key', 'home_feature')->first();
        $aboutUsData   = Section::where('key', 'home_about_us')->first();

       
        return view('admin.app.pages.home', compact('heroData', 'featureData','aboutUsData'));
    }
}
