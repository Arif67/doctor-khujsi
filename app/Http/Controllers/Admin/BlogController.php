<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\BlogRequest;
use App\Models\Blog;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;
use Intervention\Image\Facades\Image; 

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $blogs = Blog::with('category');
            return DataTables::of($blogs)
                ->addIndexColumn()
                ->addColumn('category', fn($row) => $row->category?->name ?? '—')
                ->addColumn('status', function ($row) {
                    if ($row->status == 'published') {
                        return '<span class="px-2 py-1 text-xs font-semibold rounded bg-green-100 text-green-800">Published</span>';
                    } elseif ($row->status == 'draft') {
                        return '<span class="px-2 py-1 text-xs font-semibold rounded bg-yellow-100 text-yellow-800">Draft</span>';
                    } else {
                        return '<span class="px-2 py-1 text-xs font-semibold rounded bg-red-100 text-red-800">Inactive</span>';
                    }
                })
                ->addColumn('action', function ($row) {
                    $action = '
                        <div class="flex flex-row gap-2">
                            <a href="'.route('admin.blogs.show',$row->id).'" 
                                class="inline-flex items-center px-2 py-2 bg-green-600 text-white text-sm font-medium rounded shadow hover:bg-[#04ea04] transition">
                                <i class="fas fa-eye"></i>
                            </a>
                            <a href="'.route('admin.blogs.edit',$row->id).'" 
                                class="inline-flex items-center px-2 py-2 bg-indigo-600 text-white text-sm font-medium rounded shadow hover:bg-indigo-700 transition">
                                <i class="fas fa-edit"></i>
                            </a>
                            <button 
                                data-href="'.route("admin.blogs.destroy", $row->id).'"
                                class="confirm-delete px-2 py-1 bg-red-600 text-white rounded hover:bg-red-700">
                                <i class="fas fa-trash"></i>
                            </button>
                        </div>';

                    return $action;
                })
                ->rawColumns(['action','status'])
                ->make(true);
        }

        return view('admin.blogs.index');
    }

    /**
     * Show the form for creating a new resource.
     */
     public function create()
    {
        $categories = Category::all();
        return view('admin.blogs.create', compact('categories'));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(BlogRequest $request)
    {
        $data = $request->validated();
 
        if($request->hasFile('thumbnail_image')){
            $data['thumbnail_image'] = $request->file('thumbnail_image')->store('blogs','public');
        }
        if($request->hasFile('featured_image')){
            $data['featured_image'] = $request->file('featured_image')->store('blogs','public');
        }

        $data['content'] = $this->saveSummernoteImages($request->description);

        Blog::create($data);
        return redirect()->route('admin.blogs.index')->with('success','Blog created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $blog = Blog::findOrFail($id);
        return view('admin.blogs.show', compact('blog'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Blog $blog)
    {
        $categories = Category::all();
        return view('admin.blogs.edit', compact('blog','categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(BlogRequest $request, Blog $blog)
    {
        $data = $request->validated();

        if($request->hasFile('thumbnail_image')){
            // Optionally delete old file
            if($blog->thumbnail_image) Storage::disk('public')->delete($blog->thumbnail_image);
            $data['thumbnail_image'] = $request->file('thumbnail_image')->store('blogs','public');
        }
        if($request->hasFile('featured_image')){
            if($blog->featured_image) Storage::disk('public')->delete($blog->featured_image);
            $data['featured_image'] = $request->file('featured_image')->store('blogs','public');
        }

        $data['content'] = $this->updateSummernoteImages($request->description,$blog->content);

        $blog->update($data);
        return redirect()->route('admin.blogs.index')->with('success','Blog updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Blog $blog)
    {
         // Delete thumbnail if exists
        if ($blog->thumbnail_image && Storage::disk('public')->exists($blog->thumbnail_image)) {
            Storage::disk('public')->delete($blog->thumbnail_image);
        }

        // Delete featured image if exists
        if ($blog->featured_image && Storage::disk('public')->exists($blog->featured_image)) {
            Storage::disk('public')->delete($blog->featured_image);
        }

        // Delete all images inside blog body (summernote content)
        if (!empty($blog->content)) {
            $this->deleteSummaryImages($blog->content);
        }
        $blog->delete();
        return redirect()->back()->with('success', 'Blog deleted successfully.');
    }
    private function saveSummernoteImages($content)
    {
        $dom = new \DOMDocument();
        libxml_use_internal_errors(true); // warning ignore
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
                $path = 'blogs/' . $imageName;

                Storage::disk('public')->put($path, base64_decode($imageData[1]));

                // Replace base64 with storage path
                $img->setAttribute('src', asset('storage/' . $path));
            }
        }

        return $dom->saveHTML();
    }
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
                $path = 'blogs/' . $imageName;

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
}
