@extends('layouts.admin')

@section('content')
<div class="bg-white py-5 px-5 w-full mb-5 create_preview_img {{ ($blog->thumbnail_image || $blog->featured_image) ? '' : 'hidden' }}">
   <div class="grid grid-cols-1 md:grid-cols-6 gap-5" id="preview_container">
       @if($blog->thumbnail_image)
       <div class="relative">
           <img id="thumbnail_image_preview" class="mt-2 w-full h-32 object-cover" src="{{ asset('storage/'.$blog->thumbnail_image) }}">
           <button type="button" class="absolute top-1 right-0 bg-red-600 text-white rounded py-1 px-3 delete-img" data-target="thumbnail_image"><i class="fas fa-trash"></i></button>
       </div>
       @endif
       @if($blog->featured_image)
       <div class="relative">
           <img id="featured_image_preview" class="mt-2 w-full h-32 object-cover" src="{{ asset('storage/'.$blog->featured_image) }}">
           <button type="button" class="absolute top-1 right-0 bg-red-600 text-white rounded py-1 px-3 delete-img" data-target="featured_image"><i class="fas fa-trash"></i></button>
       </div>
       @endif
   </div>
</div>

<div class="bg-white shadow rounded-lg p-6 ">
    <div class="flex justify-between items-center mb-4">
        <h2 class="text-xl font-semibold text-gray-800">Edit Blog</h2>
        <a 
            href="{{ route('admin.blogs.index') }}" 
            class="flex flex-row gap-2 items-center px-5 py-2 bg-indigo-600 text-white text-sm font-medium rounded shadow hover:bg-indigo-700 transition"
        >
           <i class="fas fa-arrow-left"></i>Back
        </a>
    </div>
    <hr class="mb-5">
    <form action="{{ route('admin.blogs.update', $blog->id) }}" method="POST" class="space-y-4" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="block font-semibold mb-1">Title</label>
                <input type="text" name="title" class="w-full border px-3 py-2 rounded" value="{{ $blog->title }}" required>
                 @error('title') <p class="text-red-500 font-semibold">{{ $message }}</p> @enderror
            </div>
            <div>
                <label class="block font-semibold mb-1">Thumbnail Image</label>
                <input type="file" name="thumbnail_image" class="w-full border  rounded" id="thumbnail_image">
                @error('thumbnail_image') <p class="text-red-500 font-semibold">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block font-semibold mb-1">Featured Image</label>
                <input type="file" name="featured_image" class="w-full border rounded" id="featured_image">
                @error('featured_image') <p class="text-red-500 font-semibold">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block font-semibold mb-1">Category</label>
                <select name="category_id" class="w-full border px-3 py-2 rounded" required>
                    <option value="">Select Category</option>
                    @foreach($categories as $c)
                    <option value="{{ $c->id }}" {{ $blog->category_id == $c->id ? 'selected' : '' }}>{{ $c->name }}</option>
                    @endforeach
                </select>
                @error('category_id') <p class="text-red-500 font-semibold">{{ $message }}</p> @enderror
            </div>
        </div>
        <div>
            <label class="block font-semibold mb-1">Short Description</label>
            <textarea name="short_description" class="w-full border px-3 py-2 rounded" required>{{ $blog->short_description }}</textarea>
        </div>
        <div>
            <label class="block font-semibold mb-1">Text</label>
            <textarea name="text" id="summernote" class="w-full border px-3 py-2 rounded" required>
                {!! $blog->content !!}
            </textarea>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="block">Status</label>
                <select name="status" class="w-full border px-3 py-2 rounded" required>
                    <option value="draft" {{ $blog->status=='draft' ? 'selected' : '' }}>Draft</option>
                    <option value="published" {{ $blog->status=='published' ? 'selected' : '' }}>Published</option>
                </select>
            </div>
            <div>
                <label class="block">Meta Title</label>
                <input type="text" name="meta_title" class="w-full border px-3 py-2 rounded" value="{{ $blog->meta_title }}">
            </div>
        </div>
        
        <div>
            <label class="block">Meta Description</label>
            <textarea name="meta_description" class="w-full border px-3 py-2 rounded">{{ $blog->meta_description }}</textarea>
        </div>
        <div>
            <label class="block">Meta Keywords</label>
            <input type="text" name="meta_keywords" class="w-full border px-3 py-2 rounded" value="{{ $blog->meta_keywords }}">
        </div>
        <div>
            <button type="submit" 
                class="inline-flex items-center px-5 py-2 bg-indigo-600 text-white text-sm font-medium rounded shadow hover:bg-indigo-700 transition">
                <i class="fas fa-save mr-2"></i>Update
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

    function handlePreview(input){
        var inputId = $(input).attr('id');
        var files = input.files;
        if(files && files[0]){
            var reader = new FileReader();
            reader.onload = function(e){
                $('.create_preview_img').removeClass('hidden');
                var existing = $('#'+inputId+'_preview');
                if(existing.length){
                    existing.attr('src', e.target.result);
                } else {
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

    $(document).on('click', '.delete-img', function(){
        var targetInput = $(this).data('target');
        $('#'+targetInput).val('');
        $('#'+targetInput+'_preview').parent().remove();
        if($('#preview_container').children().length == 0){
            $('.create_preview_img').addClass('hidden');
        }
    });
});
</script>
@endpush
