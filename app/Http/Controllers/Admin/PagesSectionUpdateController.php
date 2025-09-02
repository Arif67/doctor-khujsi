<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Page;
use App\Models\Section;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PagesSectionUpdateController extends Controller
{
    public function home_hero(Request $request){
        $section = Section::where('key', 'home_hero')->first();

        if (!$section) {
            $section = new Section();
            $section->key = 'home_hero';
        }

        $data = $section->data ?? [];

        // validation
        $request->validate([
            'heading'     => 'nullable|string|max:255',
            'title'       => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'photo'       => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        if ($request->has('delete_photo') && !empty($data['photo'])) {
            if (Storage::disk('public')->exists($data['photo'])) {
                Storage::disk('public')->delete($data['photo']);
            }
            $data['photo'] = null;
        }

        if ($request->hasFile('photo')) {
            if (!empty($data['photo']) && Storage::disk('public')->exists($data['photo'])) {
                Storage::disk('public')->delete($data['photo']);
            }

            $path = $request->file('photo')->store('sections', 'public'); 
            $data['photo'] = $path;
        }

        $data['heading']     = $request->heading;
        $data['title']       = $request->title;
        $data['description'] = $request->description;

        $section->data = $data;
        $section->save();

        return redirect()->back()->with('success', 'Hero Section updated successfully!');
    }

    public function home_feature(Request $request)
    {
        $section = Section::firstOrCreate(
            ['key' => 'home_feature'],
            ['data' => []]
        );

        $data = $request->validate([
            'features' => 'nullable|array',
            'features.*.icon' => 'nullable|string|max:255',
            'features.*.name' => 'nullable|string|max:255',
            'features.*.description' => 'nullable|string',
        ]);

        $section->update([
            'data' => $data
        ]);

        return redirect()->back()->with('success', 'Feature Section updated successfully!');
    }

    public function home_about_us(Request $request)
    {
        $section = Section::updateOrCreate(
            ['key' => 'home_about_us'],
            ['key' => 'home_about_us']
        );

        $data = $section->data ?? [];

        $request->validate([
            'title'       => 'nullable|string|max:255',
            'sub_title'   => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'image'       => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        // delete image
        if ($request->has('delete_image') && !empty($data['image'])) {
            if (Storage::disk('public')->exists($data['image'])) {
                Storage::disk('public')->delete($data['image']);
            }
            $data['image'] = null;
        }

        // upload new image
        if ($request->hasFile('image')) {
            if (!empty($data['image']) && Storage::disk('public')->exists($data['image'])) {
                Storage::disk('public')->delete($data['image']);
            }
            $path = $request->file('image')->store('sections', 'public');
            $data['image'] = $path;
        }

        $data['title']       = $request->title;
        $data['sub_title']   = $request->sub_title;
        $data['description'] = $request->description;
        $data['icons']       = $request->icons ?? [];

        $section->update(['data' => $data]);

        return redirect()->back()->with('success', 'About Us section updated successfully!');
    }


}
