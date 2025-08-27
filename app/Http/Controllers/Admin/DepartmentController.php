<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\DepartmentRequest;
use App\Models\Department;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $query = Department::query();

            return DataTables::of($query)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $action = '
                        <div class="flex flex-row gap-2">
                             <a href="'.route('admin.departments.edit',$row->id).'" 
                                class="inline-flex items-center px-2 py-2 bg-indigo-600 text-white text-sm font-medium rounded shadow hover:bg-indigo-700 transition">
                                <i class="fas fa-edit"></i>
                            </a>
                            <button 
                                onclick="openDeleteModal(\''.route('admin.departments.destroy', $row->id).'\')" 
                                class="px-2 py-1 bg-red-600 text-white rounded hover:bg-red-700">
                                <i class="fas fa-trash"></i>
                            </button>
                        </div>';

                    return $action;
                })
                ->editColumn('status', function ($row) {
                    return ucfirst($row->status);
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('admin.departments.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.departments.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(DepartmentRequest $request)
    {
        $data = $request->validated();
        Department::create($data);

        return redirect()->back()->with('success', 'Department created successfully.');
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
     public function edit(Department $department)
    {
        return view('admin.departments.edit', compact('department'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(DepartmentRequest $request, Department $department)
    {
        $department->update($request->validated());
        return redirect()->route('admin.departments.index')->with('success', 'Department updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Department $department)
    {
        $department->delete();
        return redirect()->back()->with('success', 'Department deleted successfully.');
    }
}
