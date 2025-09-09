<form action="{{ route('admin.sections.home.hero.update') }}" 
      method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-4">
        <h4 class="text-xl font-semibold text-gray-800 mb-3 md:mb-0">Home Hero Section</h4>

        <div class="my-2 relative w-40">
            <img id="photo_preview"
                src="{{ !empty($heroData->data['photo']) ? asset('storage/' . $heroData->data['photo']) : '#' }}"
                class="w-40 h-auto rounded shadow border {{ !empty($heroData->data['photo']) ? '' : 'hidden' }}" 
                alt="Image Preview">

            <button type="button" id="delete_preview"
                class="absolute top-1 right-1 bg-red-600 text-white px-2 py-1 rounded-full shadow hover:bg-red-700 hidden">
                <i class="fas fa-trash text-sm"></i>
            </button>
            
            @if(!empty($heroData->data['photo']))
                <label class="flex items-center gap-2 mt-2">
                    <input type="checkbox" name="delete_photo" value="1">
                    <span class="text-red-600 font-semibold">Delete this photo</span>
                </label>
            @endif
        </div>
    </div>

    <hr class="mb-5">

    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
        <div class="col-span-3 md:col-span-1">
            <label class="block font-semibold mb-1">Photo</label>
            <input type="file" name="photo" id="photo" 
                   class="w-full py-[6px] border rounded-lg focus:ring-2 focus:ring-blue-400 focus:outline-none">
            <small class="text-gray-500 text-sm">Upload hero image</small>
        </div>
        <div class="col-span-3 md:col-span-1">
            <label class="block font-semibold mb-1">Heading</label>
            <input type="text" name="heading" value="{{ $heroData->data['heading'] ?? '' }}" 
                   placeholder="Enter heading here"
                   class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-400 focus:outline-none">
        </div>
        <div class="col-span-3 md:col-span-1">
            <label class="block font-semibold mb-1">Title</label>
            <input type="text" name="title" value="{{ $heroData->data['title'] ?? '' }}" 
                   placeholder="Enter title here"
                   class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-400 focus:outline-none">
        </div>
        <div class="col-span-3">
            <label class="block font-semibold mb-1">Description</label>
            <textarea name="description" 
                      placeholder="Enter description here"
                      class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-400 focus:outline-none">{{ $heroData->data['description'] ?? '' }}</textarea>
        </div>
    </div>

    <div class="mt-3">
        <button type="submit" 
                class="px-5 py-2 bg-indigo-600 text-white rounded shadow hover:bg-indigo-700 flex items-center">
            <i class="fas fa-save mr-2"></i> Save
        </button>
    </div>
</form>

@push('scripts')
<script>
    $(document).ready(function () {
        // Preview image on file select
        $('#photo').on('change', function (event) {
            let input = event.target;

            if (input.files && input.files[0]) {
                let reader = new FileReader();

                reader.onload = function (e) {
                    $('#photo_preview')
                        .attr('src', e.target.result)
                        .removeClass('hidden');
                    $('#delete_preview').removeClass('hidden'); // trash icon show হবে
                }

                reader.readAsDataURL(input.files[0]);
            }
        });

        // Trash icon click (preview clear only)
        $('#delete_preview').on('click', function () {
            $('#photo_preview').attr('src', '#').addClass('hidden'); 
            $('#photo').val(''); // input clear
            $(this).addClass('hidden'); // icon hide again
        });
    });
</script>
@endpush
