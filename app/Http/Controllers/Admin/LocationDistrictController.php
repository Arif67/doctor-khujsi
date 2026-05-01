<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\LocationDistrictRequest;
use App\Models\LocationDistrict;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class LocationDistrictController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            return DataTables::of(LocationDistrict::query())
                ->addIndexColumn()
                ->addColumn('thanas_count', fn (LocationDistrict $district) => $district->thanas()->count())
                ->addColumn('action', function (LocationDistrict $district) {
                    return '
                        <div class="flex flex-row gap-2">
                            <a href="'.route('admin.districts.edit', $district->id).'" class="inline-flex items-center px-2 py-2 bg-indigo-600 text-white text-sm font-medium rounded shadow hover:bg-indigo-700 transition">
                                <i class="fas fa-edit"></i>
                            </a>
                            <button data-href="'.route('admin.districts.destroy', $district->id).'" class="confirm-delete px-2 py-1 bg-red-600 text-white rounded hover:bg-red-700">
                                <i class="fas fa-trash"></i>
                            </button>
                        </div>';
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('admin.locations.districts.index');
    }

    public function create()
    {
        return view('admin.locations.districts.create');
    }

    public function store(LocationDistrictRequest $request)
    {
        LocationDistrict::create([
            'id' => ((int) LocationDistrict::query()->max('id')) + 1,
            ...$request->validated(),
        ]);

        return redirect()->route('admin.districts.index')->with('success', 'District created successfully.');
    }

    public function edit(LocationDistrict $district)
    {
        return view('admin.locations.districts.edit', compact('district'));
    }

    public function update(LocationDistrictRequest $request, LocationDistrict $district)
    {
        $district->update($request->validated());

        return redirect()->route('admin.districts.index')->with('success', 'District updated successfully.');
    }

    public function destroy(LocationDistrict $district)
    {
        $district->delete();

        return redirect()->route('admin.districts.index')->with('success', 'District deleted successfully.');
    }
}
