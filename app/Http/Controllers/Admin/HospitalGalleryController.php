<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\HospitalGalleryRequest;
use App\Models\HospitalGallery;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class HospitalGalleryController extends Controller
{
    public function index()
    {
        $galleries = HospitalGallery::query()
            ->when(Auth::user()?->hasRole('hospital_owner'), fn ($query) => $query->where('owner_id', Auth::id()))
            ->latest()
            ->get();

        return view('admin.hospital-galleries.index', compact('galleries'));
    }

    public function create()
    {
        return view('admin.hospital-galleries.create');
    }

    public function store(HospitalGalleryRequest $request)
    {
        $data = $request->validated();
        $data['owner_id'] = Auth::id();
        $data['image'] = $request->file('image')->store('hospital-galleries', 'public');

        HospitalGallery::create($data);

        return redirect()->route('admin.hospital-galleries.index')->with('success', 'Gallery image added successfully.');
    }

    public function edit(HospitalGallery $hospitalGallery)
    {
        $this->ensureAccess($hospitalGallery);

        return view('admin.hospital-galleries.edit', compact('hospitalGallery'));
    }

    public function update(HospitalGalleryRequest $request, HospitalGallery $hospitalGallery)
    {
        $this->ensureAccess($hospitalGallery);

        $data = $request->validated();

        if ($request->hasFile('image')) {
            if ($hospitalGallery->image && Storage::disk('public')->exists($hospitalGallery->image)) {
                Storage::disk('public')->delete($hospitalGallery->image);
            }

            $data['image'] = $request->file('image')->store('hospital-galleries', 'public');
        }

        $hospitalGallery->update([
            'title' => $data['title'] ?? $hospitalGallery->title,
            'image' => $data['image'] ?? $hospitalGallery->image,
        ]);

        return redirect()->route('admin.hospital-galleries.index')->with('success', 'Gallery image updated successfully.');
    }

    public function destroy(HospitalGallery $hospitalGallery)
    {
        $this->ensureAccess($hospitalGallery);

        if ($hospitalGallery->image && Storage::disk('public')->exists($hospitalGallery->image)) {
            Storage::disk('public')->delete($hospitalGallery->image);
        }

        $hospitalGallery->delete();

        return redirect()->route('admin.hospital-galleries.index')->with('success', 'Gallery image deleted successfully.');
    }

    private function ensureAccess(HospitalGallery $hospitalGallery): void
    {
        if (Auth::user()?->hasRole('hospital_owner') && $hospitalGallery->owner_id !== Auth::id()) {
            abort(403);
        }
    }
}
