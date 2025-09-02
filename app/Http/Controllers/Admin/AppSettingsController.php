<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AppSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AppSettingsController extends Controller
{
     public function edit()
    {
        $setting = AppSetting::first();
        return view('admin.app.settings', compact('setting'));
    }

   public function update(Request $request)
    {

       //dd($request->all());
        $setting = AppSetting::firstOrNew(); 

        $data = [
            'phone' => [
                'icon' => $request->phone_icon ?? '',
                'name' => $request->phone ?? '',
            ],
            'mail' => [
                'icon' => $request->mail_icon ?? '',
                'name' => $request->mail ?? '',
            ],
            'location' => [
                'icon' => $request->location_icon ?? '',
                'name' => $request->location ?? '',
            ],
            'description' => $request->description ?? '',
        ];

         // Social icons handle
        $social = [];
        if ($request->has('social')) {
            foreach ($request->social as $s) {
                if (!empty($s['icon']) || !empty($s['name']) || !empty($s['link'])) {
                    $social[] = [
                        'icon' => $s['icon'] ?? '',
                        'name' => $s['name'] ?? '',
                        'link' => $s['link'] ?? '',
                    ];
                }
            }
        }
        $data['social'] = $social;

        // Logo handling
        if ($request->hasFile('logo')) {
            if (!empty($setting->logo['logo']) && Storage::disk('public')->exists($setting->logo['logo'])) {
                Storage::disk('public')->delete($setting->logo['logo']);
            }
            $path = $request->file('logo')->store('app_settings', 'public'); // 'public' disk
            $data['logo'] = [
                'logo' => $path,
                'title' => $request->logo_title ?? '',
            ];
        } elseif ($request->delete_logo) {
            if (Storage::disk('public')->exists($setting->logo['logo'])) {
                Storage::disk('public')->delete($setting->logo['logo']);
            }
            $data['logo'] = null;
        } else {
            $data['logo'] = $setting->logo;
        }

        $setting->fill($data);
        $setting->save();

        return redirect()->back()->with('success', 'App settings updated.');
    }

}
