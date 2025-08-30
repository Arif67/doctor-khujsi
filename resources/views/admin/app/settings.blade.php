@extends('layouts.admin')

@section('content')
<div class="bg-white shadow rounded-lg p-6">
    <form action="{{ route('admin.app.setting.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <h4 class="text-xl font-semibold text-gray-800 mb-3">App Settings</h4>
        <hr class="mb-5">    

        {{-- Phone --}}
        <div class="mb-4 grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="block font-medium">Phone Icon</label>
                <input type="text" name="phone_icon" value="{{ $setting->phone['icon'] ?? '' }}" class="border rounded px-3 py-2 w-full">
            </div>
            <div>
                <label class="block font-medium">Phone Number</label>
                <input type="text" name="phone" value="{{ $setting->phone['name'] ?? '' }}" class="border rounded px-3 py-2 w-full">
            </div>
        </div>

        {{-- Mail --}}
        <div class="mb-4 grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="block font-medium">Mail Icon</label>
                <input type="text" name="mail_icon" value="{{ $setting->mail['icon'] ?? '' }}" class="border rounded px-3 py-2 w-full">
            </div>
            <div>
                <label class="block font-medium">Email</label>
                <input type="text" name="mail" value="{{ $setting->mail['name'] ?? '' }}" class="border rounded px-3 py-2 w-full">
            </div>   
        </div>

        {{-- Location --}}
        <div class="mb-4 grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="block font-medium">Location Icon</label>
                <input type="text" name="location_icon" value="{{ $setting->location['icon'] ?? '' }}" class="border rounded px-3 py-2 w-full">
            </div>
            <div>
                <label class="block font-medium">Address</label>
                <input type="text" name="location" value="{{ $setting->location['name'] ?? '' }}" class="border rounded px-3 py-2 w-full">
            </div>  
        </div>

        {{-- Social Icons --}}
        <div class="mb-4">
            <h5 class="font-semibold mb-2">Social Icons</h5>
            <div id="social-wrapper">
                @if(!empty($setting->social))
                    @foreach($setting->social as $s)
                    <div class="flex gap-2 mb-2 items-center">
                        <input type="text" name="social[{{ $loop->index }}][icon]" value="{{ $s['icon'] ?? '' }}" class="border px-3 py-2 rounded w-1/3" placeholder="Icon">
                        <input type="text" name="social[{{ $loop->index }}][name]" value="{{ $s['name'] ?? '' }}" class="border px-3 py-2 rounded w-1/3" placeholder="Name">
                        <input type="text" name="social[{{ $loop->index }}][link]" value="{{ $s['link'] ?? '' }}" class="border px-3 py-2 rounded w-1/3" placeholder="Link">

                         <button type="button" class="remove-social bg-red-500 text-white px-2 py-1 rounded"><i class="fas fa-trash"></i></button>
                    </div>
                    @endforeach
                @endif
            </div>
            <button type="button" id="add-social" class="mt-2 px-3 py-1 bg-indigo-600 text-white rounded">+ Add Social</button>
        </div>

        {{-- Logo --}}
        <div class="mb-4">
            <h5 class="font-semibold mb-2">Logo</h5>
            <div class="mb-2">
                @if(!empty($setting->logo['logo']))
                    <img id="logo-preview" src="{{ asset('storage/' . $setting->logo['logo']) }}" class="w-32 mb-2">
                    <div class="flex flex-row gap-5">
                        <button type="button" id="delete-logo-btn" class="bg-red-500 text-white px-2 py-1 rounded">Delete</button>
                        {{-- <span class="flex flex-row gap-2 items-center">
                            <input type="checkbox" name="delete_logo" id="delete-logo" value="true"><span class="text-red-600 font-semibold">Delete this image</span>
                        </span> --}}
                    </div>
                @else
                    <img id="logo-preview" src="" class="w-32 mb-2 hidden">
                    <button type="button" id="delete-logo-btn" class="hidden bg-red-500 text-white px-2 py-1 rounded">Delete</button>
                @endif
            </div>
            <input type="hidden" name="delete_logo" id="delete-logo" value="true">
            <input type="file" name="logo" id="logo-input" class="border rounded w-full mb-2">
            <input type="text" name="logo_title" value="{{ $setting->logo['title'] ?? '' }}" placeholder="Logo Title" class="border rounded px-3 py-2 w-full">
        </div>

        {{-- Description --}}
        <div class="mb-4">
            <label class="block font-medium">Description</label>
            <textarea name="description" class="border rounded px-3 py-2 w-full" rows="4">{{ $setting->description ?? '' }}</textarea>
        </div>

        <div>
            <button type="submit" class="px-5 py-2 bg-indigo-600 text-white rounded">Save</button>
        </div>
    </form>
</div>
@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        // Social icons add/remove
       $('#add-social').click(function() {
            let index = $('#social-wrapper .flex').length;
            $('#social-wrapper').append(`
                <div class="flex gap-2 mb-2 items-center">
                    <input type="text" name="social[${index}][icon]" placeholder="Icon class"class="border px-3 py-2 rounded w-1/3">
                    <input type="text" name="social[${index}][name]" placeholder="Name" class="border px-3 py-2 rounded w-1/3">
                    <input type="text" name="social[${index}][link]" placeholder="Link" class="border px-3 py-2 rounded w-1/3">
                    <button type="button" class="remove-social bg-red-500 text-white px-2 py-1 rounded"><i class="fas fa-trash"></i></button>
                </div>
            `);
        });


        $(document).on('click', '.remove-social', function() {
            $(this).parent().remove();
        });


        // Logo preview
        $('#logo-input').on('change', function(e) {
            let reader = new FileReader();
            reader.onload = function(e){
                $('#logo-preview').attr('src', e.target.result).removeClass('hidden');
                $('#delete-logo-btn').removeClass('hidden');
                $('#delete-logo').val('');
            }
            if(this.files[0]) reader.readAsDataURL(this.files[0]);
        });

        // Delete logo
        $('#delete-logo-btn').on('click', function() {
            $('#logo-preview').attr('src','').addClass('hidden');
            $('#logo-input').val('');
            $('#delete-logo').val(true);
            $(this).addClass('hidden');
        });
    });
</script>
@endpush
