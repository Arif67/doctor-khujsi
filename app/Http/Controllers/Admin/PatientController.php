<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\PatientRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Yajra\DataTables\Facades\DataTables;

class PatientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
       if ($request->ajax()) {
            $users = User::role('patient');

            return DataTables::of($users)
                ->addIndexColumn()
                ->editColumn('first_name', function ($row) {
                    return $row->first_name ?? '-';
                })
                ->editColumn('last_name', function ($row) {
                    return $row->last_name ?? '-';
                })
                ->editColumn('email', function ($row) {
                    return $row->email ?? '-';
                })
                ->addColumn('mobile', function ($row) {
                    return $row->phone ?? '-'; 
                })
                ->editColumn('blood', function ($row) {
                    return $row->blood ?? '-';
                })
                ->editColumn('sex', function ($row) {
                    return $row->sex ?? '-';
                })
                ->editColumn('date_of_birth', function ($row) {
                    return $row->date_of_birth ?? '-';
                })
                ->addColumn('action', function ($row) {
                    return '
                        <div class="flex flex-row gap-2">
                            <a href="'.route('admin.patients.edit',$row->id).'" 
                                class="inline-flex items-center px-2 py-2 bg-indigo-600 text-white text-sm font-medium rounded shadow hover:bg-indigo-700 transition">
                                <i class="fas fa-edit"></i>
                            </a>
                            <button 
                                data-href="'.route("admin.patients.destroy", $row->id).'"
                                class="confirm-delete px-2 py-1 bg-red-600 text-white rounded hover:bg-red-700">
                                <i class="fas fa-trash"></i>
                            </button>
                        </div>';
                })
                ->rawColumns(['action','photo'])
                ->make(true);
        }

    return view('admin.patients.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.patients.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PatientRequest $request)
    {
        $patient = new User($request->except(['password','photo']));
        
         if($request->hasFile('photo')){
            $filename = time().'.'.$request->photo->extension();
            $request->photo->move(public_path('uploads/patients'), $filename);
            $patient->photo = $filename;
        }

        $patient->password = Hash::make($request->password);
        $patient->plan_password = $request->password;
        $patient->save();
        $patientRole = Role::firstOrCreate([
            'name' => 'patient',
            'guard_name' => 'web'
        ]);
        $patient->assignRole($patientRole);
        return redirect()->route('admin.patients.index')->with('success','Patient created successfully.');

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
    public function edit(User $patient)
    {
        return view('admin.patients.edit',compact('patient'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PatientRequest $request, User $patient)
    {
        $patient->fill($request->except(['password','photo']));
        
        if ($request->has('delete_photo') && $patient->photo) {
            $photoPath = public_path('uploads/patients/' . $patient->photo);
            if (file_exists($photoPath)) {
                unlink($photoPath); 
            }
            $patient->photo = null; 
        }


        if ($request->hasFile('photo')) {
            if ($patient->photo) {
                $oldPath = public_path('uploads/patients/' . $patient->photo);
                if (file_exists($oldPath)) unlink($oldPath);
            }

            $filename = time().'.'.$request->photo->extension();
            $request->photo->move(public_path('uploads/patients'), $filename);
            $patient->photo = $filename;
        }
        if($request->filled('password')){
            $patient->password = Hash::make($request->password);
            $patient->plan_password = $request->password;
        }

        $patient->save();

        return redirect()->route('admin.patients.index')->with('success','Patient updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $patient)
    {
        if ($patient->photo) {
            $photoPath = public_path('uploads/patients/' . $patient->photo);
            if (file_exists($photoPath)) {
                unlink($photoPath); 
            }
        }
        $patient->delete();
        return redirect()->back()->with('success','Patient Deleted successfully.');
    }
}
