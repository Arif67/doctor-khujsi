<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ServiceRequest;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Yajra\DataTables\Facades\DataTables;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $isHospitalOwner = Auth::user()?->hasRole('hospital_owner');

        if ($request->ajax()) {
            $services = Service::query()
                ->with('owner')
                ->when($isHospitalOwner, fn ($query) => $query->where('owner_id', Auth::id()));

            return DataTables::of($services)
                ->addIndexColumn()
                ->addColumn('image', function ($row) {
                    if (!$row->image) {
                        return '<span class="text-gray-400 text-sm">No image</span>';
                    }

                    return '<img src="' . asset('storage/' . $row->image) . '" alt="' . e($row->title) . '" class="w-16 h-16 rounded object-cover">';
                })
                ->addColumn('hospital', fn ($row) => $row->owner?->hospital_name ?: $row->owner?->name ?: '-')
                ->editColumn('description', function ($row) {
                    return Str::limit(strip_tags($row->description), 50);
                })
                ->editColumn('created_at', function ($row) {
                    return \Carbon\Carbon::parse($row->created_at)->format('d M Y, h:i A');
                })
                ->addColumn('action', function($row){
                   $action = '
                        <div class="flex flex-row gap-2">
                             <a href="'.route('admin.services.edit',$row->id).'" 
                                class="inline-flex items-center px-2 py-2 bg-indigo-600 text-white text-sm font-medium rounded shadow hover:bg-indigo-700 transition">
                                <i class="fas fa-edit"></i>
                            </a>
                            <button 
                                data-href="'.route("admin.services.destroy", $row->id).'"
                                class="confirm-delete px-2 py-1 bg-red-600 text-white rounded hover:bg-red-700">
                                <i class="fas fa-trash"></i>
                            </button>
                        </div>';

                    return $action;
                })
                ->rawColumns(['action', 'image'])
                ->make(true);
        }

        return view('admin.services.index', compact('isHospitalOwner'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.services.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ServiceRequest $request)
    {
        $data = $request->validated();
        $data['owner_id'] = Auth::user()?->hasRole('hospital_owner')
            ? Auth::id()
            : $request->input('owner_id');

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('services', 'public');
        }

        Service::create($data);

        return redirect()->route('admin.services.index')->with('success','Service created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Service $service)
    {
        $this->ensureServiceAccess($service);

        return view('admin.services.edit', compact('service'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ServiceRequest  $request, Service $service)
    {
        $this->ensureServiceAccess($service);

        $data = $request->validated();
        $data['owner_id'] = Auth::user()?->hasRole('hospital_owner')
            ? $service->owner_id
            : ($request->input('owner_id') ?: $service->owner_id);

        if ($request->hasFile('image')) {
            if ($service->image && Storage::disk('public')->exists($service->image)) {
                Storage::disk('public')->delete($service->image);
            }

            $data['image'] = $request->file('image')->store('services', 'public');
        }

        $service->update($data);

        return redirect()->route('admin.services.index')->with('success','Service updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Service $service)
    {
        $this->ensureServiceAccess($service);

        if ($service->image && Storage::disk('public')->exists($service->image)) {
            Storage::disk('public')->delete($service->image);
        }

        $service->delete();
        return redirect()->route('admin.services.index')->with('success','Service deleted successfully.');
    }

    private function ensureServiceAccess(Service $service): void
    {
        if (Auth::user()?->hasRole('hospital_owner') && $service->owner_id !== Auth::id()) {
            abort(403);
        }
    }
}
