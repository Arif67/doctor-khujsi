<?php

namespace App\Http\Controllers;

use App\Models\LocationArea;
use App\Models\LocationDistrict;
use App\Models\LocationThana;

class LocationController extends Controller
{
    public function thanas(LocationDistrict $district)
    {
        return response()->json(
            $district->thanas()
                ->select('id', 'name', 'bn_name')
                ->orderBy('name')
                ->get()
        );
    }

    public function areas(LocationThana $thana)
    {
        return response()->json(
            $thana->areas()
                ->select('id', 'name', 'bn_name')
                ->orderBy('name')
                ->get()
        );
    }

    public function areaSearch(LocationArea $area)
    {
        return response()->json($area);
    }
}
