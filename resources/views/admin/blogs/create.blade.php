@extends('layouts.admin')

@section('content')
<div class="bg-white py-5 px-5 w-full mb-5 create_preview_img hidden">
   <div class="grid grid-cols-1 md:grid-cols-6 gap-5" id="preview_container">
   </div>
</div>

<div class="bg-white shadow rounded-lg p-6 ">
    <div class="flex justify-between items-center mb-4">
        <h2 class="text-xl font-semibold text-gray-800">Create Blog</h2>
        <a 
            href="{{ route('admin.blogs.index') }}" 
            class="flex flex-row gap-2 items-center px-5 py-2 bg-indigo-600 text-white text-sm font-medium rounded shadow hover:bg-indigo-700 transition"
        >
            All Blog
        </a>
    </div>
    <hr class="mb-5">
   <form action="{{ route('admin.blogs.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
    @csrf
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <div>
            <label class="block font-semibold mb-1">Title (English)</label>
            <input type="text" name="title" value="{{ old('title') }}" class="w-full border px-3 py-2 rounded" placeholder="Enter blog title in English" required>
            @error('title') <p class="text-red-500 font-semibold">{{ $message }}</p> @enderror
        </div>
        <div>
            <label class="block font-semibold mb-1">Title (Bangla)</label>
            <input type="text" name="title_bn" value="{{ old('title_bn') }}" class="w-full border px-3 py-2 rounded" placeholder="Enter blog title in Bangla">
            @error('title_bn') <p class="text-red-500 font-semibold">{{ $message }}</p> @enderror
        </div>
        <div>
            <label class="block font-semibold mb-1">Thumbnail Image</label>
            <input type="file" name="thumbnail_image" class="w-full border py-[6px] rounded" id="thumbnail_image">
            @error('thumbnail_image') <p class="text-red-500 font-semibold">{{ $message }}</p> @enderror
        </div>

        <div>
            <label class="block font-semibold mb-1">Featured Image</label>
            <input type="file" name="featured_image" class="w-full py-[6px] border rounded" id="featured_image">
            @error('featured_image') <p class="text-red-500 font-semibold">{{ $message }}</p> @enderror
        </div>

        <div>
            <label class="block font-semibold mb-1">Category</label>
            <select name="category_id" class="w-full border px-3 py-2 rounded" required>
                <option value="">Select Category</option>
                @foreach($categories as $c)
                <option value="{{ $c->id }}">{{ $c->name }}</option>
                @endforeach
            </select>
            @error('category_id') <p class="text-red-500 font-semibold">{{ $message }}</p> @enderror
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <div>
        <label class="block font-semibold mb-1">Short Description (English)</label>
        <textarea name="short_description" class="w-full border px-3 py-2 rounded" placeholder="Enter a short description in English">{{ old('short_description') }}</textarea>
        @error('short_description') <p class="text-red-500 font-semibold">{{ $message }}</p> @enderror
    </div>
        <div>
        <label class="block font-semibold mb-1">Short Description (Bangla)</label>
        <textarea name="short_description_bn" class="w-full border px-3 py-2 rounded" placeholder="Enter a short description in Bangla">{{ old('short_description_bn') }}</textarea>
        @error('short_description_bn') <p class="text-red-500 font-semibold">{{ $message }}</p> @enderror
    </div>
    </div>

    <div class="grid grid-cols-1 gap-4">
        <div>
        <label class="block font-semibold mb-1">Text (English)</label>
        <textarea name="description" id="summernote" class="w-full border px-3 py-2 rounded" placeholder="Enter the blog content in English"></textarea>
        @error('description') <p class="text-red-500 font-semibold">{{ $message }}</p> @enderror
    </div>
        <div>
        <label class="block font-semibold mb-1">Text (Bangla)</label>
        <textarea name="description_bn" id="summernote_bn" class="w-full border px-3 py-2 rounded" placeholder="Enter the blog content in Bangla"></textarea>
        @error('description_bn') <p class="text-red-500 font-semibold">{{ $message }}</p> @enderror
    </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <div>
            <label class="block">Status</label>
            <select name="status" class="w-full border px-3 py-2 rounded" required>
                <option value="draft" @selected(old('status') === 'draft')>Draft</option>
                <option value="published" @selected(old('status') === 'published')>Published</option>
            </select>
        </div>
        <div>
            <label class="block">Meta Title (English)</label>
            <input type="text" name="meta_title" value="{{ old('meta_title') }}" class="w-full border px-3 py-2 rounded" placeholder="Enter meta title in English">
        </div>
        <div>
            <label class="block">Meta Title (Bangla)</label>
            <input type="text" name="meta_title_bn" value="{{ old('meta_title_bn') }}" class="w-full border px-3 py-2 rounded" placeholder="Enter meta title in Bangla">
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <div>
        <label class="block">Meta Description (English)</label>
        <textarea name="meta_description" class="w-full border px-3 py-2 rounded" placeholder="Enter meta description in English">{{ old('meta_description') }}</textarea>
    </div>
        <div>
        <label class="block">Meta Description (Bangla)</label>
        <textarea name="meta_description_bn" class="w-full border px-3 py-2 rounded" placeholder="Enter meta description in Bangla">{{ old('meta_description_bn') }}</textarea>
    </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <div>
        <label class="block">Meta Keywords (English)</label>
        <input type="text" name="meta_keywords" value="{{ old('meta_keywords') }}" class="w-full border px-3 py-2 rounded" placeholder="Enter meta keywords separated by commas">
    </div>
        <div>
        <label class="block">Meta Keywords (Bangla)</label>
        <input type="text" name="meta_keywords_bn" value="{{ old('meta_keywords_bn') }}" class="w-full border px-3 py-2 rounded" placeholder="Enter Bangla meta keywords separated by commas">
    </div>
    </div>

    <div>
        <button type="submit" 
            class="inline-flex items-center px-5 py-2 bg-indigo-600 text-white text-sm font-medium rounded shadow hover:bg-indigo-700 transition">
            <i class="fas fa-save mr-2"></i> Save
        </button>
    </div>
</form>

</div>
@endsection

@push('scripts')
<script>
   $(document).ready(function(){
    $('#summernote').summernote({
        placeholder: 'Write your blog content here...',
        tabsize: 2,
        height: 300,
        toolbar: [
            ['style', ['style']],
            ['font', ['bold', 'italic', 'underline','clear']],
            ['fontname', ['fontname']],
            ['para', ['ul', 'ol', 'paragraph']],
            ['insert', ['link', 'picture', 'video']],
            ['view', ['codeview']]
        ]
    });
    $('#summernote_bn').summernote({
        placeholder: 'বাংলা ব্লগ কনটেন্ট এখানে লিখুন...',
        tabsize: 2,
        height: 300,
        toolbar: [
            ['style', ['style']],
            ['font', ['bold', 'italic', 'underline','clear']],
            ['fontname', ['fontname']],
            ['para', ['ul', 'ol', 'paragraph']],
            ['insert', ['link', 'picture', 'video']],
            ['view', ['codeview']]
        ]
    });
    function handlePreview(input){
        var inputId = $(input).attr('id');
        var files = input.files;
        if(files && files[0]){
            var reader = new FileReader();
            reader.onload = function(e){
                // যদি div hidden থাকে, দেখাও
                $('.create_preview_img').removeClass('hidden');

                // check if preview img already exists
                var existing = $('#'+inputId+'_preview');
                if(existing.length){
                    existing.attr('src', e.target.result);
                } else {
                    // create preview div
                    var html = '<div class="relative">' +
                               '<img id="'+inputId+'_preview" class="mt-2 w-full h-32 object-cover" src="'+e.target.result+'">' +
                               '<button type="button" class="absolute top-1 right-0 bg-red-600 text-white rounded py-1 px-3 delete-img" data-target="'+inputId+'"><i class="fas fa-trash"></i></button>' +
                               '</div>';
                    $('#preview_container').append(html);
                }
            }
            reader.readAsDataURL(files[0]);
        }
    }

    $('input[type="file"]').change(function(){
        handlePreview(this);
    });

    // Delete handler (dynamic)
    $(document).on('click', '.delete-img', function(){
        var targetInput = $(this).data('target');
        $('#'+targetInput).val(''); // clear input
        $('#'+targetInput+'_preview').parent().remove(); // remove preview div

        // hide parent div if no previews
        if($('#preview_container').children().length == 0){
            $('.create_preview_img').addClass('hidden');
        }
    });
});
</script>
@endpush
