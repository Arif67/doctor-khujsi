<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\DoctorRequest;
use App\Models\Department;
use App\Models\Doctor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;

class DoctorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $query = Doctor::with('department');
            return DataTables::of($query)
                ->addIndexColumn()
                ->addColumn('department', fn($row) => $row->department?->name ?? '-')
                ->addColumn('action', function ($row) {
                   $action = '
                        <div class="flex flex-row gap-2">
                            <a href="'.route('admin.doctors.show',$row->id).'" 
                                class="inline-flex items-center px-2 py-2 bg-green-600 text-white text-sm font-medium rounded shadow hover:bg-[#04ea04] transition">
                                <i class="fas fa-eye"></i>
                            </a>
                            <a href="'.route('admin.doctors.edit',$row->id).'" 
                                class="inline-flex items-center px-2 py-2 bg-indigo-600 text-white text-sm font-medium rounded shadow hover:bg-indigo-700 transition">
                                <i class="fas fa-edit"></i>
                            </a>
                            <button 
                                onclick="openDeleteModal(\''.route('admin.doctors.destroy', $row->id).'\')" 
                                class="px-2 py-1 bg-red-600 text-white rounded hover:bg-red-700">
                                <i class="fas fa-trash"></i>
                            </button>
                        </div>';

                    return $action;
                })
                ->editColumn('status', fn($row)=> ucfirst($row->status))
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('admin.doctors.index');
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $departments = Department::all();
        return view('admin.doctors.create', compact('departments'));
    }

    /**
     * Store a newly created resource in storage.
     */
     public function store(DoctorRequest $request)
    {

        $data = $request->validated();
        if ($request->hasFile('photo')) {
            $data['photo'] = $request->file('photo')->store('doctors','public');
        }
        Doctor::create($data);
        return redirect()->route('admin.doctors.index')->with('success','Doctor created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Doctor $doctor)
    {
        return view('admin.doctors.show', compact('doctor'));
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Doctor $doctor)
    {
        $departments = Department::all();
        return view('admin.doctors.edit', compact('doctor','departments'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(DoctorRequest $request, Doctor $doctor)
    {
        $data = $request->validated();

        if($request->has('delete_photo_db') && !$request->hasFile('photo')){
            if($doctor->photo){
                Storage::disk('public')->delete($doctor->photo);
                $doctor->photo = null;
            }
        }

        if($request->hasFile('photo')){
            if($doctor->photo){
                Storage::disk('public')->delete($doctor->photo); 
            }

            $doctor->photo = $request->file('photo')->store('doctors','public'); 
        }

        $doctor->update($request->except(['photo','delete_photo_db']));

        return redirect()->route('admin.doctors.index')->with('success','Doctor updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
     public function destroy(Doctor $doctor)
    {
        if($doctor->photo) Storage::disk('public')->delete($doctor->photo);
        $doctor->delete();
        return redirect()->back()->with('success','Doctor deleted successfully.');
    }
}
