<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AttentionRequest;
use App\Models\Attention;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class AttentionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Attention::query();
            return DataTables::of($data)
                ->addIndexColumn()
                ->editColumn('created_at', fn($row) => $row->created_at->format('d M Y, h:i A'))
                ->addColumn('action', function($row){
                    $action = '
                        <div class="flex flex-row gap-2">
                             <a href="'.route('admin.attentions.edit',$row->id).'" 
                                class="inline-flex items-center px-2 py-2 bg-indigo-600 text-white text-sm font-medium rounded shadow hover:bg-indigo-700 transition">
                                <i class="fas fa-edit"></i>
                            </a>
                            <button 
                                onclick="openDeleteModal(\''.route('admin.attentions.destroy', $row->id).'\')" 
                                class="px-2 py-1 bg-red-600 text-white rounded hover:bg-red-700">
                                <i class="fas fa-trash"></i>
                            </button>
                        </div>';

                    return $action;
                })
                ->rawColumns(['action','icon'])
                ->make(true);
        }
        return view('admin.attentions.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.attentions.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AttentionRequest $request)
    {
        Attention::create($request->validated());
        return redirect()->back()->with('success','Attention created successfully');
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
     public function edit(Attention $attention)
    {
        return view('admin.attentions.edit', compact('attention'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AttentionRequest $request, Attention $attention)
    {
        $attention->update($request->validated());
        return redirect()->route('admin.attentions.index')->with('success','Attention updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Attention $attention)
    {
        $attention->delete();
        return redirect()->route('admin.attentions.index')->with('success','Attention deleted successfully');
    }
}
