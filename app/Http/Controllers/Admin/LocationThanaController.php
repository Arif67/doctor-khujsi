<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\LocationThanaRequest;
use App\Models\LocationDistrict;
use App\Models\LocationThana;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class LocationThanaController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            return DataTables::of(LocationThana::query()->with('district'))
                ->addIndexColumn()
                ->addColumn('district', fn (LocationThana $thana) => $thana->district?->name ?? '—')
                ->addColumn('areas_count', fn (LocationThana $thana) => $thana->areas()->count())
                ->addColumn('action', function (LocationThana $thana) {
                    return '
                        <div class="flex flex-row gap-2">
                            <a href="'.route('admin.thanas.edit', $thana->id).'" class="inline-flex items-center px-2 py-2 bg-indigo-600 text-white text-sm font-medium rounded shadow hover:bg-indigo-700 transition">
                                <i class="fas fa-edit"></i>
                            </a>
                            <button data-href="'.route('admin.thanas.destroy', $thana->id).'" class="confirm-delete px-2 py-1 bg-red-600 text-white rounded hover:bg-red-700">
                                <i class="fas fa-trash"></i>
                            </button>
                        </div>';
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('admin.locations.thanas.index');
    }

    public function create()
    {
        $districts = LocationDistrict::query()->orderBy('name')->get(['id', 'name']);

        return view('admin.locations.thanas.create', compact('districts'));
    }

    public function store(LocationThanaRequest $request)
    {
        LocationThana::create([
            'id' => ((int) LocationThana::query()->max('id')) + 1,
            ...$request->validated(),
        ]);

        return redirect()->route('admin.thanas.index')->with('success', 'Thana created successfully.');
    }

    public function edit(LocationThana $thana)
    {
        $districts = LocationDistrict::query()->orderBy('name')->get(['id', 'name']);

        return view('admin.locations.thanas.edit', compact('thana', 'districts'));
    }

    public function update(LocationThanaRequest $request, LocationThana $thana)
    {
        $thana->update($request->validated());

        return redirect()->route('admin.thanas.index')->with('success', 'Thana updated successfully.');
    }

    public function destroy(LocationThana $thana)
    {
        $thana->delete();

        return redirect()->route('admin.thanas.index')->with('success', 'Thana deleted successfully.');
    }
}
