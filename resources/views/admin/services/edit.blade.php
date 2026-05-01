@extends('layouts.admin')

@section('content')
<div class="bg-white p-6 rounded-lg shadow">
     <div class="flex justify-between items-center mb-4">
        <h2 class="text-xl font-semibold">Edit Service</h2>
        <a href="{{ route('admin.services.index') }}" class="flex flex-row gap-3 items-center px-5 py-2 bg-indigo-600 text-white text-sm font-medium rounded shadow hover:bg-indigo-700 transition">
            <i class="fas fa-arrow-left"></i>Back
        </a>
    </div>
    <hr class="mb-5">
    <form action="{{ route('admin.services.update',$service->id) }}" method="POST" enctype="multipart/form-data">
        @csrf @method('PUT')
        <div class="mb-4">
            <label class="block mb-1 font-semibold">Image</label>
            <input type="file" name="image" class="w-full border p-2 rounded" accept="image/*">
            @error('image') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror

            @if ($service->image)
                <img src="{{ asset('storage/' . $service->image) }}" alt="{{ $service->title }}" class="w-24 h-24 rounded object-cover mt-3">
            @endif
        </div>
        <div class="mb-4">
            <label class="block mb-1 font-semibold">Title (English)</label>
            <input type="text" name="title" value="{{ old('title',$service->getRawOriginal('title')) }}" 
                   class="w-full border p-2 rounded">
            @error('title') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
        </div>
        <div class="mb-4">
            <label class="block mb-1 font-semibold">Title (Bangla)</label>
            <input type="text" name="title_bn" value="{{ old('title_bn',$service->getRawOriginal('title_bn')) }}" 
                   class="w-full border p-2 rounded">
            @error('title_bn') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
        </div>
       <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <div class="mb-4">
            <label class="block mb-1 font-semibold">Description (English)</label>
            <textarea name="description" id="summernote" class="w-full border px-3 py-2 rounded" required>{{ old('description', $service->getRawOriginal('description')) }}</textarea>
            @error('description') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
       </div>
        <div class="mb-4">
            <label class="block mb-1 font-semibold">Description (Bangla)</label>
            <textarea name="description_bn" id="summernote_bn" class="w-full border px-3 py-2 rounded">{{ old('description_bn', $service->getRawOriginal('description_bn')) }}</textarea>
            @error('description_bn') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
       </div>
       </div>
        <div>
            <button type="submit" 
                class="inline-flex items-center px-5 py-2 bg-indigo-600 text-white text-sm font-medium rounded shadow hover:bg-indigo-700 transition">
                <i class="fas fa-save mr-2"></i> Update
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
        placeholder: 'বাংলা সার্ভিস কনটেন্ট এখানে লিখুন...',
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
});
</script>
@endpush
