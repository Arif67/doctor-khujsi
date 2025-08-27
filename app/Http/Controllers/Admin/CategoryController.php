<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $categories = Category::with('parent');
            return DataTables::of($categories)
                ->addIndexColumn()
                ->addColumn('parent', fn($row) => $row?->parent?->name ?? '—')
                ->addColumn('action', function ($row) {
                    $action = '
                        <div class="flex flex-row gap-2">
                             <a href="'.route('admin.categories.edit',$row->id).'" 
                                class="inline-flex items-center px-2 py-2 bg-indigo-600 text-white text-sm font-medium rounded shadow hover:bg-indigo-700 transition">
                                <i class="fas fa-edit"></i>
                            </a>
                            <button 
                                onclick="openDeleteModal(\''.route('admin.categories.destroy', $row->id).'\')" 
                                class="px-2 py-1 bg-red-600 text-white rounded hover:bg-red-700">
                                <i class="fas fa-trash"></i>
                            </button>
                        </div>';

                    return $action;
                    
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('admin.categories.index');
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $parents = Category::all();
        return view('admin.categories.create', compact('parents'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoryRequest $request)
    {
        Category::create($request->validated());
        return redirect()->back()->with('success','Category created successfully');
    }


    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
     public function edit(Category $category)
    {
        $parents = Category::where('id','!=',$category->id)->get();
        return view('admin.categories.edit', compact('category','parents'));
    }

    /**
     * Update the specified resource in storage.
     */
     public function update(CategoryRequest $request, Category $category)
    {
        $category->update($request->validated());
        return redirect()->back()->with('success','Category updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        $category->delete();
        return redirect()->back()->with('success', 'Categiry deleted successfully.');
    }
}
