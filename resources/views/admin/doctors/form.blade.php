@csrf
<div class="grid grid-cols-1 md:grid-cols-2 gap-4">
    <div class="mb-4">
        <label class="block font-medium mb-1">Name</label>
        <input type="text" name="name" value="{{ old('name',$doctor->name ?? '') }}" class="w-full border p-2 rounded" required>
    </div>
    <div class="mb-4">
        <label class="block font-medium mb-1">Email</label>
        <input type="email" name="email" value="{{ old('email',$doctor->email ?? '') }}" class="w-full border p-2 rounded">
    </div>
    <div class="mb-4">
        <label class="block font-medium mb-1">Phone</label>
        <input type="text" name="phone" value="{{ old('phone',$doctor->phone ?? '') }}" class="w-full border p-2 rounded">
    </div>
    <div class="mb-4">
        <label class="block font-medium mb-1">Department</label>
        <select name="department_id" class="w-full border p-2 rounded">
            <option value="">Select Department</option>
            @foreach($departments as $dep)
                <option value="{{ $dep->id }}" {{ (old('department_id',$doctor->department_id ?? '') == $dep->id)?'selected':'' }}>{{ $dep->name }}</option>
            @endforeach
        </select>
    </div>
    <div class="mb-4">
        <label class="block font-medium mb-1">Qualification</label>
        <input type="text" name="qualification" value="{{ old('qualification',$doctor->qualification ?? '') }}" class="w-full border p-2 rounded">
    </div>
    
    <div class="mb-4">
        <label class="block font-medium mb-1">Specialization</label>
        <input type="text" name="specialization" value="{{ old('specialization',$doctor->specialization ?? '') }}" class="w-full border p-2 rounded">
    </div>
    <div class="mb-4">
        <label class="block font-medium mb-1">Status</label>
        <select name="status" class="w-full border p-2 rounded">
            <option value="active" {{ (old('status',$doctor->status ?? 'active')=='active')?'selected':'' }}>Active</option>
            <option value="inactive" {{ (old('status',$doctor->status ?? '')=='inactive')?'selected':'' }}>Inactive</option>
        </select>
    </div>
    <div class="mb-4 relative">
        <label class="block font-medium mb-1">Profile Photo</label>
        
        <input type="file" name="photo" id="profile_photo_input" class="w-full border rounded">

        <div class="mt-2 relative inline-block">
            <!-- Preview Image -->
            <img id="profile_photo_preview" 
                src="{{ isset($doctor->photo) ? asset('storage/'.$doctor->photo) : '' }}" 
                class="w-24 h-24 object-cover rounded {{ isset($doctor->photo) ? '' : 'hidden' }}">

            <!-- Delete Button -->
            <button type="button" id="delete_photo_btn" 
                    class="absolute top-0 right-0 bg-red-600 text-white rounded-full w-6 h-6 flex items-center justify-center hover:bg-red-700 {{ isset($doctor->profile_photo) ? '' : 'hidden' }}">
                &times;
            </button>
        </div>

        @if(isset($doctor->photo))
            <div class="mt-1">
                <label class="inline-flex items-center">
                    <input type="checkbox" name="delete_photo_db" id="delete_photo_db" class="form-checkbox">
                    <span class="ml-2 text-sm text-gray-700">Delete from database</span>
                </label>
            </div>
        @endif
    </div>

    <div class="col-span-2">
        <button type="submit" 
            class="inline-flex items-center px-5 py-2 bg-indigo-600 text-white text-sm font-medium rounded shadow hover:bg-indigo-700 transition">
            <i class="fas fa-save mr-2"></i> @isset($department) Update @else Save @endisset
        </button>
    </div>
</div>

@push('scripts')
<script>
   $(document).ready(function(){

    var deleteFromDB = false;

    // Checkbox change (Edit)
    $('#delete_photo_db').on('change', function(){
        deleteFromDB = $(this).is(':checked');
    });

    // File input change (preview new image)
    $('#profile_photo_input').on('change', function(e){
        var file = e.target.files[0];
        var preview = $('#profile_photo_preview');
        var deleteBtn = $('#delete_photo_btn');

        if(file){
            var reader = new FileReader();
            reader.onload = function(e){
                preview.attr('src', e.target.result);
                preview.removeClass('hidden');
                deleteBtn.removeClass('hidden');
            }
            reader.readAsDataURL(file);
        } else {
            preview.attr('src','').addClass('hidden');
            deleteBtn.addClass('hidden');
        }
    });

    // Delete icon click
    $('#delete_photo_btn').on('click', function(){
        var preview = $('#profile_photo_preview');
        var input = $('#profile_photo_input');
        
        preview.attr('src','').addClass('hidden');
        input.val(''); // clear file input

        // Hide delete button if no photo
        $(this).addClass('hidden');
    });

});
</script>
@endpush
