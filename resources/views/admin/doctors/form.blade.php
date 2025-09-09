@csrf
<div class="grid grid-cols-1 md:grid-cols-2 gap-4">
   <div class="col-span-2">
        <div class="grid grid-cols-1 md:grid-cols-3 row-gap-3 gap-4">
            {{-- Name --}}
            <div>
                <label class="block font-medium mb-1">Name</label>
                <input type="text" name="name" value="{{ old('name', $doctor->name ?? '') }}" class="w-full border p-2 rounded" required>
                @error('name') <p class="text-red-500">{{ $message }}</p> @enderror
            </div>

            {{-- Email --}}
            <div>
                <label class="block font-medium mb-1">Email</label>
                <input type="email" name="email" value="{{ old('email', $doctor->email ?? '') }}" class="w-full border p-2 rounded">
                @error('email') <p class="text-red-500">{{ $message }}</p> @enderror
            </div>
        </div>
   </div>
    
    <div class="col-span-2">
        <div class="grid grid-cols-1 md:grid-cols-3 row-gap-3 gap-4">
            {{-- Phone --}}
        <div class="">
            <label class="block font-medium mb-1">Phone</label>
            <input type="text" name="phone" value="{{ old('phone', $doctor->phone ?? '') }}" class="w-full border p-2 rounded">
            @error('phone') <p class="text-red-500">{{ $message }}</p> @enderror
        </div>
         {{-- Department --}}
        <div class="">
            <label class="block font-medium mb-1">Department</label>
            <select name="department_id" class="w-full border p-2 rounded">
                <option value="">Select Department</option>
                @foreach($departments as $dep)
                    <option value="{{ $dep->id }}" {{ (old('department_id',$doctor->department_id ?? '') == $dep->id)?'selected':'' }}>
                        {{ $dep->name }}
                    </option>
                @endforeach
            </select>
            @error('department_id') <p class="text-red-500">{{ $message }}</p> @enderror
        </div>
        {{-- office Phone --}}
        <div class="">
            <label class="block font-medium mb-1">Office Phone</label>
            <input type="text" name="office_phone" value="{{ old('office_phone', $doctor->office_phone ?? '') }}" class="w-full border p-2 rounded">
            @error('office_phone') <p class="text-red-500">{{ $message }}</p> @enderror
        </div>
        </div>
        
    </div>
     <div class="col-span-2">
        <div class="grid grid-cols-1 md:grid-cols-3 row-gap-3 gap-4">
            {{-- Status --}}
            <div>
                <label class="block font-medium mb-1">Status</label>
                <select name="status" class="w-full border p-2 rounded">
                    <option value="active" {{ (old('status',$doctor->status ?? 'active')=='active')?'selected':'' }}>Active</option>
                    <option value="inactive" {{ (old('status',$doctor->status ?? '')=='inactive')?'selected':'' }}>Inactive</option>
                </select>
                @error('status') <p class="text-red-500">{{ $message }}</p> @enderror
            </div>

            {{-- Profile Photo --}}
            <div class="relative">
                <label class="block font-medium mb-1">Profile Photo</label>
                <input type="file" name="photo" id="profile_photo_input" class="w-full py-[6px] border rounded">

                <div class="mt-2 relative inline-block">
                    <img id="profile_photo_preview" 
                        src="{{ isset($doctor->photo) ? asset('storage/'.$doctor->photo) : '' }}" 
                        class="w-24 h-24 object-cover rounded {{ isset($doctor->photo) ? '' : 'hidden' }}">
                    <button type="button" id="delete_photo_btn" 
                            class="absolute top-0 right-0 bg-red-600 text-white rounded-full w-6 h-6 flex items-center justify-center hover:bg-red-700 {{ isset($doctor->photo) ? '' : 'hidden' }}">
                        &times;
                    </button>
                </div>
            </div>
       </div>
    </div>
    {{-- Description --}}
    <div class="col-span-2">
        <label class="block font-semibold mb-1">Short Description</label>
        <textarea name="description" id="summernote" class="w-full border px-3 py-2 rounded">{{ old('description',$doctor->description ?? '') }}</textarea>
        @error('description') <p class="text-red-500">{{ $message }}</p> @enderror
    </div>

        {{-- Education --}}
    <div class="col-span-2">
        <h4 class="font-semibold mb-2">Education & Experience</h4>
        @php $educations = old('educations', $doctor->educations ?? [['title'=>'','details'=>'']]); @endphp
        <div id="educations_wrapper">
            @foreach($educations as $i => $edu)
                <div class="flex flex-col md:flex-row gap-2 mb-2 education_row">
                    <input 
                        type="text" 
                        name="educations[{{ $i }}][title]" 
                        placeholder="Title" 
                        class="border p-2 rounded w-full md:w-1/3"
                        value="{{ old("educations.$i.title", $edu['title'] ?? '') }}">
                    
                    <input 
                        type="text" 
                        name="educations[{{ $i }}][details]" 
                        placeholder="Details" 
                        class="border p-2 rounded w-full md:w-2/3"
                        value="{{ old("educations.$i.details", $edu['details'] ?? '') }}">
                    
                    <button 
                        type="button" 
                        class="remove_education_btn bg-red-600 text-white px-2 py-1 rounded w-full md:w-auto flex justify-center items-center">
                        <i class="fas fa-trash"></i>
                    </button>
                </div>
            @endforeach
        </div>

        <button 
            type="button" 
            id="add_education_btn" 
            class="mt-2 bg-indigo-600 text-white px-3 py-2 rounded flex gap-2 items-center">
            <i class="fas fa-plus"></i> Add
        </button>
    </div>


    {{-- Shifts --}}
    <div class="col-span-2">
        <h4 class="font-semibold mb-2">Working Shifts</h4>
        @php $shifts = old('shifts', $doctor->shifts ?? [['day'=>'','start_time'=>'','end_time'=>'']]); @endphp
        <div id="shifts_wrapper">
            @foreach($shifts as $i => $shift)
                <div class="flex flex-col md:flex-row gap-2 mb-2 shift_row">
                    <input type="text" 
                        name="shifts[{{ $i }}][day]" 
                        placeholder="Day" 
                        class="border p-2 rounded w-full md:w-1/4"
                        value="{{ old("shifts.$i.day", $shift['day'] ?? '') }}">
                    
                    <input type="time" 
                        name="shifts[{{ $i }}][start_time]" 
                        class="border p-2 rounded w-full md:w-1/4"
                        value="{{ old("shifts.$i.start_time", $shift['start_time'] ?? '') }}">
                    
                    <input type="time" 
                        name="shifts[{{ $i }}][end_time]" 
                        class="border p-2 rounded w-full md:w-1/4"
                        value="{{ old("shifts.$i.end_time", $shift['end_time'] ?? '') }}">
                    
                    <button type="button" 
                            class="remove_shift_btn bg-red-600 text-white px-2 py-1 rounded w-full md:w-auto flex justify-center items-center">
                        <i class="fas fa-trash"></i>
                    </button>
                </div>
            @endforeach
        </div>

        <button type="button" id="add_shift_btn" class="mt-2 bg-indigo-600 text-white px-3 py-2 rounded flex gap-2 items-center">
            <i class="fas fa-plus"></i> Shift
        </button>
    </div>

    {{-- Social Links --}}
    <div class="col-span-2">
        <h4 class="font-semibold mb-2">Social Links</h4>
        @php $social_links = old('social_links', $doctor->social_links ?? [['platform'=>'','url'=>'']]); @endphp
        <div id="social_wrapper">
            @foreach($social_links as $i => $link)
                <div class="flex flex-col md:flex-row gap-2 mb-2 social_row">
                    <input type="text" 
                        name="social_links[{{ $i }}][platform]" 
                        placeholder="Platform" 
                        class="border p-2 rounded w-full md:w-1/4"
                        value="{{ old("social_links.$i.platform", $link['platform'] ?? '') }}">
                    
                    <input type="url" 
                        name="social_links[{{ $i }}][url]" 
                        placeholder="URL" 
                        class="border p-2 rounded w-full md:w-3/4"
                        value="{{ old("social_links.$i.url", $link['url'] ?? '') }}">
                    
                    <button type="button" 
                            class="remove_social_btn bg-red-600 text-white px-2 py-1 rounded w-full md:w-auto flex justify-center items-center">
                        <i class="fas fa-trash"></i>
                    </button>
                </div>
            @endforeach
        </div>

        <button type="button" id="add_social_btn" class="mt-2 bg-indigo-600 text-white px-3 py-2 rounded flex gap-2 items-center">
            <i class="fas fa-plus"></i> Add
        </button>
    </div>


    {{-- Submit --}}
    <div class="col-span-2">
        <button type="submit" class="inline-flex items-center px-5 py-2 bg-indigo-600 text-white text-sm font-medium rounded shadow hover:bg-indigo-700 transition">
            <i class="fas fa-save mr-2"></i> @isset($doctor) Update @else Save @endisset
        </button>
    </div>
</div>

@push('scripts')
<script>
$(document).ready(function(){

    // Summernote
    $('#summernote').summernote({
        placeholder: 'Write here...',
        tabsize: 2,
        height: 300,
        toolbar: [
            ['style', ['style']],
            ['font', ['bold', 'italic', 'underline','clear']],
            ['para', ['ul', 'ol', 'paragraph']],
            ['insert', ['link', 'picture', 'video']],
            ['view', ['codeview']]
        ]
    });

    // --- Profile Photo Preview ---
    $('#profile_photo_input').on('change', function(e){
        const file = e.target.files[0];
        if(file){
            const reader = new FileReader();
            reader.onload = e => {
                $('#profile_photo_preview').attr('src', e.target.result).removeClass('hidden');
                $('#delete_photo_btn').removeClass('hidden');
            };
            reader.readAsDataURL(file);
        }
    });

    $('#delete_photo_btn').on('click', function(){
        $('#profile_photo_preview').attr('src','').addClass('hidden');
        $('#profile_photo_input').val('');
        $(this).addClass('hidden');
    });

    // --- Dynamic Fields ---
    function getIndex(wrapper, rowClass){
        return $(wrapper + ' .' + rowClass).length;
    }

    // Education
    $('#add_education_btn').click(function(){
        let i = getIndex('#educations_wrapper', 'education_row');
        $('#educations_wrapper').append(`
            <div class="flex gap-2 mb-2 education_row">
                <input type="text" name="educations[${i}][title]" placeholder="Title" class="border p-2 rounded w-1/3">
                <input type="text" name="educations[${i}][details]" placeholder="Details" class="border p-2 rounded w-2/3">
                <button type="button" class="remove_education_btn bg-red-600 text-white px-2 rounded"><i class="fas fa-trash"></i></button>
            </div>
        `);
    });
    $(document).on('click', '.remove_education_btn', function(){ $(this).closest('.education_row').remove(); });

    // Shifts
    $('#add_shift_btn').click(function(){
        let i = getIndex('#shifts_wrapper', 'shift_row');
        $('#shifts_wrapper').append(`
            <div class="flex gap-2 mb-2 shift_row">
                <input type="text" name="shifts[${i}][day]" placeholder="Day" class="border p-2 rounded w-1/4">
                <input type="time" name="shifts[${i}][start_time]" class="border p-2 rounded w-1/4">
                <input type="time" name="shifts[${i}][end_time]" class="border p-2 rounded w-1/4">
                <button type="button" class="remove_shift_btn bg-red-600 text-white px-2 rounded"><i class="fas fa-trash"></i></button>
            </div>
        `);
    });
    $(document).on('click', '.remove_shift_btn', function(){ $(this).closest('.shift_row').remove(); });

    // Social Links
    $('#add_social_btn').click(function(){
        let i = getIndex('#social_wrapper', 'social_row');
        $('#social_wrapper').append(`
            <div class="flex gap-2 mb-2 social_row">
                <input type="text" name="social_links[${i}][platform]" placeholder="Platform" class="border p-2 rounded w-1/4">
                <input type="url" name="social_links[${i}][url]" placeholder="URL" class="border p-2 rounded w-3/4">
                <button type="button" class="remove_social_btn bg-red-600 text-white px-2 rounded"><i class="fas fa-trash"></i></button>
            </div>
        `);
    });
    $(document).on('click', '.remove_social_btn', function(){ $(this).closest('.social_row').remove(); });

});
</script>
@endpush
