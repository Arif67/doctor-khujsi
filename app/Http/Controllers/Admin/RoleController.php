<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Yajra\DataTables\Facades\DataTables;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $roles = Role::with('permissions');
            return DataTables::of($roles)
                ->addIndexColumn()
                ->addColumn('permissions', function ($row) {
                    return $row->permissions->map(function($p) {
                        return '<span class="px-2 py-1 bg-blue-100 text-blue-800 text-xs rounded">' . $p->name . '</span>';
                    })->implode(' ');
                })
                ->addColumn('action', function ($row) {
                    $edit = '<a href="'.route('admin.roles.edit',$row->id).'" 
                                class="px-2 py-1 mr-1 bg-blue-500 text-white rounded">
                                <i class="fas fa-edit"></i>
                            </a>';

                   $delete = '<button 
                        onclick="openDeleteModal(\''.route('admin.roles.destroy', $row->id).'\')"
                        class="px-2 py-1 bg-red-600 text-white rounded hover:bg-red-700">
                        <i class="fas fa-trash"></i>
                    </button>';
                    return $edit.' '.$delete;
                })
                ->rawColumns(['permissions','action'])
                ->make(true);
        }

        return view('admin.roles.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $permissions = Permission::all();
        return view('admin.roles.create', compact('permissions'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:roles,name',
            'permissions' => 'array'
        ]);

        $role = Role::create(['name' => $request->name]);
      
        $permissions = $request->permissions ?? [];
        $permissionModels = Permission::whereIn('id', $permissions)->get();
        $role->syncPermissions($permissionModels);

        return redirect()->route('admin.roles.index')->with('success', 'Role created successfully.');
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
    public function edit(Role $role)
    {
        $permissions = Permission::all();
        return view('admin.roles.edit', compact('role', 'permissions'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Role $role)
    {
        $request->validate([
            'name' => 'required|unique:roles,name,' . $role->id,
            'permissions' => 'array'
        ]);

        $role->update(['name' => $request->name]);

        $permissions = $request->permissions ?? [];
        $permissionModels = Permission::whereIn('id', $permissions)->get();
        $role->syncPermissions($permissionModels);

        return redirect()->route('admin.roles.index')->with('success', 'Role updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Role $role)
    {
        $role->delete();
        return redirect()->route('admin.roles.index')->with('success', 'Role deleted successfully.');
    }
}
