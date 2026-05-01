<div>
    <label class="block text-gray-700 mb-1" for="title">Title</label>
    <input type="text" name="title" id="title" value="{{ old('title', $hospitalGallery->title ?? '') }}" class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-400 focus:outline-none" placeholder="e.g. Emergency Building, ICU Floor">
    @error('title') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
</div>

<div>
    <label class="block text-gray-700 mb-1" for="image">Image</label>
    <input type="file" name="image" id="image" accept="image/*" class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-400 focus:outline-none">
    @error('image') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
</div>

<div>
    <img id="gallery_preview" src="{{ isset($hospitalGallery) && $hospitalGallery->image ? asset('storage/' . $hospitalGallery->image) : asset('assets/img/register.jpg') }}" alt="Gallery preview" class="w-full max-w-md h-72 object-cover rounded-2xl border">
</div>

<div>
    <button type="submit" class="inline-flex items-center px-5 py-2 bg-indigo-600 text-white text-sm font-medium rounded shadow hover:bg-indigo-700 transition">
        <i class="fas fa-save mr-2"></i> Save
    </button>
</div>

@push('scripts')
<script>
document.getElementById('image')?.addEventListener('change', function(event) {
    const [file] = event.target.files || [];

    if (!file) {
        return;
    }

    const reader = new FileReader();
    reader.onload = function(loadEvent) {
        document.getElementById('gallery_preview').src = loadEvent.target.result;
    };
    reader.readAsDataURL(file);
});
</script>
@endpush
