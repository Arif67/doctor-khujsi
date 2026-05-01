<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\DoctorRequest;
use App\Models\Department;
use App\Models\Doctor;
use App\Models\LocationDistrict;
use App\Support\BangladeshLocation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
            $query = Doctor::with(['department', 'owner']);

            if (Auth::user()?->hasRole('hospital_owner')) {
                $query->where('owner_id', Auth::id());
            }

            return DataTables::of($query)
                ->addIndexColumn()
                ->addColumn('photo', function($row) {
                    if ($row->photo) {
                        $url = asset('storage/'.$row->photo);
                        return '<img src="'.$url.'" alt="photo" class="w-6 h-6 rounded-full object-cover" />';
                    }
                    return '<img src="'.asset('assets/img/default.png').'" alt="default" class="w-6 h-6 rounded-full object-cover" />';
                })
                ->addColumn('department', fn($row) => $row->department?->name ?? '-')
                ->addColumn('hospital', fn($row) => $row->owner?->hospital_name ?? '-')
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
                                data-href="'.route("admin.doctors.destroy", $row->id).'"
                                class="confirm-delete px-2 py-1 bg-red-600 text-white rounded hover:bg-red-700">
                                <i class="fas fa-trash"></i>
                            </button>
                        </div>';

                    return $action;
                })
                ->rawColumns(['action','photo'])
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
        return view('admin.doctors.create', [
            'departments' => $departments,
            'districts' => LocationDistrict::query()->orderBy('name')->get(['id', 'name']),
            'locationSelection' => ['district_id' => null, 'thana_id' => null, 'area_id' => null],
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(DoctorRequest $request)
    {
        $data = $request->validated();
        $locations = BangladeshLocation::namesFromIds(
            $request->integer('district_id') ?: null,
            $request->integer('thana_id') ?: null,
            $request->integer('area_id') ?: null,
        );
        $isHospitalOwner = Auth::user()?->hasRole('hospital_owner');
        $data['show_on_homepage'] = $isHospitalOwner ? false : $request->boolean('show_on_homepage');
        $data['owner_id'] = $isHospitalOwner
            ? Auth::id()
            : ($data['owner_id'] ?? null);
        $data['district'] = $locations['district'];
        $data['thana'] = $locations['thana'];
        $data['area'] = $locations['area'];
        unset($data['district_id'], $data['thana_id'], $data['area_id']);

        // --- Photo Upload ---
        if ($request->hasFile('photo')) {
            $data['photo'] = $request->file('photo')->store('doctors', 'public');
        }

        // --- Handle Description (Summernote + Images) ---
        $data['description'] = $this->saveSummernoteImages($request->description ?? '');

        // --- JSON fields (already nested) ---
        $data['educations']   = $request->educations ?? [];
        $data['shifts']       = $request->shifts ?? [];
        $data['social_links'] = $request->social_links ?? [];

        Doctor::create($data);

        return redirect()->route('admin.doctors.index')
            ->with('success', 'Doctor created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Doctor $doctor)
    {
        $this->ensureDoctorAccess($doctor);
        return view('admin.doctors.show', compact('doctor'));
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Doctor $doctor)
    {
        $this->ensureDoctorAccess($doctor);
        $departments = Department::all();
        return view('admin.doctors.edit', [
            'doctor' => $doctor,
            'departments' => $departments,
            'districts' => LocationDistrict::query()->orderBy('name')->get(['id', 'name']),
            'locationSelection' => BangladeshLocation::idsFromNames($doctor->district, $doctor->thana, $doctor->area),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(DoctorRequest $request, Doctor $doctor)
    {
        $this->ensureDoctorAccess($doctor);
        $data = $request->validated();
        $locations = BangladeshLocation::namesFromIds(
            $request->integer('district_id') ?: null,
            $request->integer('thana_id') ?: null,
            $request->integer('area_id') ?: null,
        );
        $isHospitalOwner = Auth::user()?->hasRole('hospital_owner');
        $data['show_on_homepage'] = $isHospitalOwner ? $doctor->show_on_homepage : $request->boolean('show_on_homepage');
        $data['owner_id'] = $isHospitalOwner
            ? $doctor->owner_id
            : ($data['owner_id'] ?? $doctor->owner_id);
        $data['district'] = $locations['district'];
        $data['thana'] = $locations['thana'];
        $data['area'] = $locations['area'];
        unset($data['district_id'], $data['thana_id'], $data['area_id']);

        // --- Handle Delete Photo ---
        if ($request->has('delete_photo_db') && !$request->hasFile('photo')) {
            if ($doctor->photo) {
                Storage::disk('public')->delete($doctor->photo);
                $doctor->photo = null;
            }
        }

        // --- Handle Upload New Photo ---
        if ($request->hasFile('photo')) {
            if ($doctor->photo) {
                Storage::disk('public')->delete($doctor->photo);
            }
            $data['photo'] = $request->file('photo')->store('doctors', 'public');
        }

        // --- Handle Description (Summernote + Images) ---
        $data['description'] = $this->updateSummernoteImages(
            $request->description ?? '',
            $doctor->description
        );

        // --- JSON fields (nested arrays directly from request) ---
        $data['educations']   = $request->educations ?? [];
        $data['shifts']       = $request->shifts ?? [];
        $data['social_links'] = $request->social_links ?? [];

        // --- Update doctor ---
        $doctor->update(collect($data)->except(['delete_photo_db'])->toArray());

        return redirect()->route('admin.doctors.index')
            ->with('success', 'Doctor updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Doctor $doctor)
    {
        $this->ensureDoctorAccess($doctor);
        if($doctor->photo) Storage::disk('public')->delete($doctor->photo);
        if (!empty($doctor->description)) {
            $this->deleteSummaryImages($doctor->description);
        }
        $doctor->delete();
        return redirect()->back()->with('success','Doctor deleted successfully.');
    }
    
    /**
     * Save summernote images from base64
     */
    private function saveSummernoteImages($content)
    {
        $dom = new \DOMDocument();
        libxml_use_internal_errors(true);
        $dom->loadHTML($content, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);

        $images = $dom->getElementsByTagName('img');

        foreach ($images as $img) {
            $src = $img->getAttribute('src');

            // Base64 image detect
            if (preg_match('/^data:image\/(\w+);base64,/', $src)) {
                $imageData = explode(',', $src);
                $mimeType = explode(';', substr($src, 5))[0];
                $extension = explode('/', $mimeType)[1]; // jpg, png etc.

                $imageName = uniqid() . '.' . $extension;
                $path = 'doctors/' . $imageName;

                Storage::disk('public')->put($path, base64_decode($imageData[1]));

                // Replace base64 with storage path
                $img->setAttribute('src', asset('storage/' . $path));
            }
        }

        return $dom->saveHTML();
    }

    /**
     * Update summernote images (add new, delete old)
     */
    private function updateSummernoteImages($content, $oldContent = null)
    {
        $dom = new \DOMDocument();
        libxml_use_internal_errors(true);
        $dom->loadHTML($content, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);

        $images = $dom->getElementsByTagName('img');
        $newImagePaths = [];

        foreach ($images as $img) {
            $src = $img->getAttribute('src');

            if (preg_match('/^data:image\/(\w+);base64,/', $src)) {
                $imageData = explode(',', $src);
                $mimeType = explode(';', substr($src, 5))[0];
                $extension = explode('/', $mimeType)[1];

                $imageName = uniqid() . '.' . $extension;
                $path = 'doctors/' . $imageName;

                Storage::disk('public')->put($path, base64_decode($imageData[1]));

                $img->setAttribute('src', asset('storage/' . $path));
                $newImagePaths[] = 'storage/' . $path;
            } else {
                $newImagePaths[] = $src;
            }
        }

        // Delete old removed images
        if ($oldContent) {
            $oldDom = new \DOMDocument();
            libxml_use_internal_errors(true);
            $oldDom->loadHTML($oldContent, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);

            $oldImages = $oldDom->getElementsByTagName('img');
            foreach ($oldImages as $oldImg) {
                $oldSrc = $oldImg->getAttribute('src');
                if (!in_array($oldSrc, $newImagePaths)) {
                    $relativePath = str_replace(asset('storage') . '/', '', $oldSrc);
                    if (Storage::disk('public')->exists($relativePath)) {
                        Storage::disk('public')->delete($relativePath);
                    }
                }
            }
        }

        return $dom->saveHTML();
    }

    private function deleteSummaryImages($content)
    {
        if (empty($content)) return;

        $dom = new \DOMDocument();
        libxml_use_internal_errors(true); // prevent HTML warnings
        $dom->loadHTML($content, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);

        $images = $dom->getElementsByTagName('img');

        foreach ($images as $img) {
            $src = $img->getAttribute('src');

            // convert full asset url to relative storage path
            $relativePath = str_replace(asset('storage') . '/', '', $src);

            if (Storage::disk('public')->exists($relativePath)) {
                Storage::disk('public')->delete($relativePath);
            }
        }
    }

    private function ensureDoctorAccess(Doctor $doctor): void
    {
        if (Auth::user()?->hasRole('hospital_owner') && $doctor->owner_id !== Auth::id()) {
            abort(403);
        }
    }
}
