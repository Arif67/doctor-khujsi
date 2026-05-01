<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\LocationAreaRequest;
use App\Models\LocationArea;
use App\Models\LocationDistrict;
use App\Models\LocationThana;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class LocationAreaController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            return DataTables::of(LocationArea::query()->with('thana.district'))
                ->addIndexColumn()
                ->addColumn('district', fn (LocationArea $area) => $area->thana?->district?->name ?? '—')
                ->addColumn('thana', fn (LocationArea $area) => $area->thana?->name ?? '—')
                ->addColumn('action', function (LocationArea $area) {
                    return '
                        <div class="flex flex-row gap-2">
                            <a href="'.route('admin.areas.edit', $area->id).'" class="inline-flex items-center px-2 py-2 bg-indigo-600 text-white text-sm font-medium rounded shadow hover:bg-indigo-700 transition">
                                <i class="fas fa-edit"></i>
                            </a>
                            <button data-href="'.route('admin.areas.destroy', $area->id).'" class="confirm-delete px-2 py-1 bg-red-600 text-white rounded hover:bg-red-700">
                                <i class="fas fa-trash"></i>
                            </button>
                        </div>';
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('admin.locations.areas.index');
    }

    public function create()
    {
        $districts = LocationDistrict::query()->orderBy('name')->get(['id', 'name']);

        return view('admin.locations.areas.create', compact('districts'));
    }

    public function store(LocationAreaRequest $request)
    {
        $validated = $request->validated();

        abort_unless(
            LocationThana::query()->whereKey($validated['thana_id'])->where('district_id', $validated['district_id'])->exists(),
            422,
            'Selected thana does not belong to the selected district.'
        );

        LocationArea::create([
            'id' => ((int) LocationArea::query()->max('id')) + 1,
            'thana_id' => $validated['thana_id'],
            'name' => $validated['name'],
            'bn_name' => $validated['bn_name'] ?? null,
            'url' => $validated['url'] ?? null,
        ]);

        return redirect()->route('admin.areas.index')->with('success', 'Area created successfully.');
    }

    public function edit(LocationArea $area)
    {
        $area->load('thana.district');
        $districts = LocationDistrict::query()->orderBy('name')->get(['id', 'name']);
        $thanas = LocationThana::query()
            ->where('district_id', $area->thana?->district_id)
            ->orderBy('name')
            ->get(['id', 'name']);

        return view('admin.locations.areas.edit', compact('area', 'districts', 'thanas'));
    }

    public function update(LocationAreaRequest $request, LocationArea $area)
    {
        $validated = $request->validated();

        abort_unless(
            LocationThana::query()->whereKey($validated['thana_id'])->where('district_id', $validated['district_id'])->exists(),
            422,
            'Selected thana does not belong to the selected district.'
        );

        $area->update([
            'thana_id' => $validated['thana_id'],
            'name' => $validated['name'],
            'bn_name' => $validated['bn_name'] ?? null,
            'url' => $validated['url'] ?? null,
        ]);

        return redirect()->route('admin.areas.index')->with('success', 'Area updated successfully.');
    }

    public function destroy(LocationArea $area)
    {
        $area->delete();

        return redirect()->route('admin.areas.index')->with('success', 'Area deleted successfully.');
    }
}
