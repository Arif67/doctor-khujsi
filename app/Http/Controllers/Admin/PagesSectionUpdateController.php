<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Doctor;
use App\Models\Service;
use App\Models\Section;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PagesSectionUpdateController extends Controller
{
    protected function normalizeLink(?string $url, string $fallback = '#'): string
    {
        return filled($url) ? $url : $fallback;
    }

    protected function sliderSection(): Section
    {
        return Section::firstOrCreate(
            ['key' => 'home_hero_slider'],
            ['data' => ['slides' => []]]
        );
    }

    protected function sliderSlides(Section $section): array
    {
        return collect($section->data['slides'] ?? [])->values()->all();
    }

    protected function sliderValidationRules(bool $includeDeletePhoto = false): array
    {
        $rules = [
            'link' => 'nullable|string|max:500',
            'photo' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:4096',
        ];

        if ($includeDeletePhoto) {
            $rules['delete_photo'] = 'nullable|boolean';
        }

        return $rules;
    }

    protected function makeSliderSlide(array $validated, ?string $currentPhoto = null): array
    {
        $storedPhoto = $currentPhoto;
        $deletePhoto = (bool) ($validated['delete_photo'] ?? false);

        if ($deletePhoto && filled($storedPhoto) && Storage::disk('public')->exists($storedPhoto)) {
            Storage::disk('public')->delete($storedPhoto);
            $storedPhoto = null;
        }

        if (!empty($validated['photo'])) {
            if (filled($storedPhoto) && Storage::disk('public')->exists($storedPhoto)) {
                Storage::disk('public')->delete($storedPhoto);
            }

            $storedPhoto = $validated['photo']->store('sections/slides', 'public');
        }

        return [
            'link' => $this->normalizeLink($validated['link'] ?? '#', '#'),
            'photo' => $storedPhoto,
        ];
    }

    protected function persistSliderSlides(Section $section, array $slides): void
    {
        $section->update([
            'data' => [
                'slides' => array_values($slides),
            ],
        ]);
    }

    protected function validSlideIndex(array $slides, int $slideIndex): bool
    {
        return array_key_exists($slideIndex, $slides);
    }

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

    public function home_hero_slider(Request $request)
    {
        return $this->storeHomeHeroSlide($request);
    }

    public function storeHomeHeroSlide(Request $request)
    {
        $validated = $request->validate($this->sliderValidationRules());
        $section = $this->sliderSection();
        $slides = $this->sliderSlides($section);
        $slides[] = $this->makeSliderSlide($validated);

        $this->persistSliderSlides($section, $slides);

        return redirect()->back()->with('success', 'Slider slide created successfully!');
    }

    public function updateHomeHeroSlide(Request $request, int $slideIndex)
    {
        $section = $this->sliderSection();
        $slides = $this->sliderSlides($section);

        if (!$this->validSlideIndex($slides, $slideIndex)) {
            return redirect()->back()->with('error', 'Slide not found.');
        }

        $validated = $request->validate($this->sliderValidationRules(true));
        $slides[$slideIndex] = $this->makeSliderSlide($validated, $slides[$slideIndex]['photo'] ?? null);

        $this->persistSliderSlides($section, $slides);

        return redirect()->back()->with('success', 'Slider slide updated successfully!');
    }

    public function destroyHomeHeroSlide(int $slideIndex)
    {
        $section = $this->sliderSection();
        $slides = $this->sliderSlides($section);

        if (!$this->validSlideIndex($slides, $slideIndex)) {
            return redirect()->back()->with('error', 'Slide not found.');
        }

        $photo = $slides[$slideIndex]['photo'] ?? null;

        if (filled($photo) && Storage::disk('public')->exists($photo)) {
            Storage::disk('public')->delete($photo);
        }

        unset($slides[$slideIndex]);
        $this->persistSliderSlides($section, $slides);

        return redirect()->back()->with('success', 'Slider slide deleted successfully!');
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

    public function home_featured_hospitals(Request $request)
    {
        $validated = $request->validate([
            'title' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'hospital_ids' => 'nullable|array|max:10',
            'hospital_ids.*' => 'integer|distinct|exists:users,id',
        ]);

        $selectedIds = collect($validated['hospital_ids'] ?? [])
            ->map(fn ($id) => (int) $id)
            ->values();

        if ($selectedIds->isNotEmpty()) {
            $approvedHospitalIds = User::query()
                ->role('hospital_owner')
                ->where('approval_status', 'approved')
                ->whereIn('id', $selectedIds)
                ->pluck('id')
                ->map(fn ($id) => (int) $id);

            if ($approvedHospitalIds->count() !== $selectedIds->count()) {
                return redirect()->back()->with('error', 'Selected hospitals must be approved hospital accounts.');
            }
        }

        Section::updateOrCreate(
            ['key' => 'home_featured_hospitals'],
            ['data' => [
                'title' => $validated['title'] ?? null,
                'description' => $validated['description'] ?? null,
                'hospital_ids' => $selectedIds->all(),
            ]]
        );

        return redirect()->back()->with('success', 'Featured hospitals updated successfully!');
    }

    public function home_services(Request $request)
    {
        $validated = $request->validate([
            'title' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'display_count' => 'nullable|integer|min:1|max:24',
            'service_ids' => 'nullable|array|max:24',
            'service_ids.*' => 'integer|distinct|exists:services,id',
        ]);

        $selectedIds = collect($validated['service_ids'] ?? [])
            ->map(fn ($id) => (int) $id)
            ->values();

        if ($selectedIds->isNotEmpty()) {
            $approvedServiceIds = Service::query()
                ->whereIn('id', $selectedIds)
                ->whereHas('owner', fn ($query) => $query->role('hospital_owner')->where('approval_status', 'approved'))
                ->pluck('id')
                ->map(fn ($id) => (int) $id);

            if ($approvedServiceIds->count() !== $selectedIds->count()) {
                return redirect()->back()->with('error', 'Selected services must belong to approved hospital accounts.');
            }
        }

        $displayCount = (int) ($validated['display_count'] ?? 6);

        Section::updateOrCreate(
            ['key' => 'home_services'],
            ['data' => [
                'title' => $validated['title'] ?? null,
                'description' => $validated['description'] ?? null,
                'display_count' => $displayCount,
                'service_ids' => $selectedIds->all(),
            ]]
        );

        return redirect()->back()->with('success', 'Homepage services updated successfully!');
    }

    public function home_featured_doctors(Request $request)
    {
        $validated = $request->validate([
            'title' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'display_count' => 'nullable|integer|min:1|max:24',
            'doctor_ids' => 'nullable|array|max:24',
            'doctor_ids.*' => 'integer|distinct|exists:doctors,id',
        ]);

        $selectedIds = collect($validated['doctor_ids'] ?? [])
            ->map(fn ($id) => (int) $id)
            ->values();

        if ($selectedIds->isNotEmpty()) {
            $approvedDoctorIds = Doctor::query()
                ->whereIn('id', $selectedIds)
                ->where('status', 'active')
                ->whereHas('owner', fn ($query) => $query->role('hospital_owner')->where('approval_status', 'approved'))
                ->pluck('id')
                ->map(fn ($id) => (int) $id);

            if ($approvedDoctorIds->count() !== $selectedIds->count()) {
                return redirect()->back()->with('error', 'Selected doctors must be active and belong to approved hospital accounts.');
            }
        }

        $displayCount = (int) ($validated['display_count'] ?? 6);

        Section::updateOrCreate(
            ['key' => 'home_featured_doctors'],
            ['data' => [
                'title' => $validated['title'] ?? null,
                'description' => $validated['description'] ?? null,
                'display_count' => $displayCount,
                'doctor_ids' => $selectedIds->all(),
            ]]
        );

        return redirect()->back()->with('success', 'Homepage featured doctors updated successfully!');
    }


}
