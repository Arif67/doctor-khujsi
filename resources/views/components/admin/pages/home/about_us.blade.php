<form action="{{ route('admin.sections.home.about_us.update') }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT') 

    <h4 class="text-xl font-semibold text-gray-800 mb-3">About Us Section</h4>

    {{-- Current Image Preview --}}
    @if(!empty($aboutUsData->data['image']))
        <div class="my-2">
            <img src="{{ asset('storage/' . $aboutUsData->data['image']) }}" class="w-40 h-auto rounded shadow" id="current-image">
            <label class="flex items-center gap-2 mt-2">
                <input type="checkbox" name="delete_image" value="1">
                <span class="text-red-600 font-semibold">Delete this image</span>
            </label>
        </div>
    @endif

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <div class="col-span-2 md:col-span-1">
            <label class="block font-semibold">Image</label>
            <input type="file" name="image" class="w-full py-[6px] border rounded-lg" id="image-input">
           <div class="mt-2 relative w-40">
            {{-- Image Preview --}}
            <img id="preview-image" 
                class="w-40 h-auto rounded shadow hidden">

            {{-- Delete Button --}}
            <button type="button" id="delete-image-btn" 
                    class="absolute top-0 right-0 bg-red-600 text-white px-2 py-1 rounded-full text-xs hidden">
                ✕
            </button>
        </div>
        </div>
        <div class="col-span-2 md:col-span-1">
            <label class="block font-semibold">Sub Title</label>
            <input type="text" name="sub_title" value="{{ $aboutUsData->data['sub_title'] ?? '' }}" class="w-full px-4 py-2 border rounded-lg">
        </div>
        <div class="col-span-2">
            <label class="block font-semibold">Title</label>
            <input type="text" name="title" value="{{ $aboutUsData->data['title'] ?? '' }}" class="w-full px-4 py-2 border rounded-lg">
        </div>
        <div class="col-span-2">
            <label class="block font-semibold">Description</label>
            <textarea name="description" class="w-full px-4 py-2 border rounded-lg">{{ $aboutUsData->data['description'] ?? '' }}</textarea>
        </div>
    </div>

    {{-- Multiple Icons --}}
    <div class="mt-4">
        <h5 class="font-semibold mb-2">Icons & Names</h5>
        <div id="icon-wrapper">
            @if(!empty($aboutUsData->data['icons']))
                @foreach($aboutUsData->data['icons'] as $index => $icon)
                    <div class="flex items-center gap-2 mb-2 icon-item">
                        <input type="text" name="icons[{{ $index }}][icon]" value="{{ $icon['icon'] ?? '' }}" placeholder="Icon class" class="px-3 py-2 border rounded w-1/2">
                        <input type="text" name="icons[{{ $index }}][name]" value="{{ $icon['name'] ?? '' }}" placeholder="Name" class="px-3 py-2 border rounded w-1/2">
                        <button type="button" class="remove-icon bg-red-500 text-white px-2 py-1 rounded">X</button>
                    </div>
                @endforeach
            @endif
        </div>
        <button type="button" id="add-icon" class="mt-2 px-4 py-2 bg-green-600 text-white rounded">+ Add Icon</button>

    </div>

    <div class="mt-3">
        <button type="submit" class="px-5 py-2 bg-indigo-600 text-white rounded shadow hover:bg-indigo-700">
            <i class="fas fa-save mr-2"></i> Save
        </button>
    </div>
</form>


@push('scripts')
<script>
    $(document).ready(function () {

        // Image Preview
        $('#image-input').on('change', function (e) {
            let reader = new FileReader();
            reader.onload = function (e) {
                $('#preview-image').attr('src', e.target.result).removeClass('hidden');
                $('#delete-image-btn').removeClass('hidden');
            }
            if (this.files[0]) {
                reader.readAsDataURL(this.files[0]);
            }
        });

        // Add Icon
        $('#add-icon').click(function () {
            let index = $('#icon-wrapper .flex').length;
            $('#icon-wrapper').append(`
                <div class="flex items-center gap-2 mb-2 icon-item">
                    <input type="text" name="icons[${index}][icon]" placeholder="Icon class (e.g., fas fa-star)" class="px-3 py-2 border rounded w-1/2">
                    <input type="text" name="icons[${index}][name]" placeholder="Name" class="px-3 py-2 border rounded w-1/2">
                    <button type="button" class="remove-icon bg-red-500 text-white px-2 py-1 rounded">X</button>
                </div>
            `);
        });


        // Remove Icon
        $(document).on('click', '.remove-icon', function () {
            $(this).closest('.icon-item').remove();
            
            // Re-index করে name ঠিক করা
            $('#icon-wrapper .icon-item').each(function (i, el) {
                $(el).find('input[name*="[icon]"]').attr('name', `icons[${i}][icon]`);
                $(el).find('input[name*="[name]"]').attr('name', `icons[${i}][name]`);
            });
        });

        $('#delete-image-btn').on('click', function () {
            $('#preview-image').attr('src', '').addClass('hidden'); 
            $('#image-input').val(''); 
            $(this).addClass('hidden'); 
        });


    });
</script>
@endpush
