@extends('layouts.admin')

@section('content')
<div class="">
    <div class="bg-white shadow rounded-lg p-6 ">
        <form action="" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="grid grid-cols-1">
                <div>
                    <h4 class="font-semibold text-2xl">Home Hero Section</h4>
                    <hr class="my-3">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-gray-700 mb-1 font-semibold" for="heading">Heading</label>
                            <input type="text" name="heading" id="heading" placeholder="Enter Heading"
                                class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-400 focus:outline-none">
                            @error('heading')
                                <span class="text-[red] font-semibold">{{ $message }}</span>
                            @enderror
                        </div>
                         <div>
                            <label class="block text-gray-700 mb-1 font-semibold" for="title">Title</label>
                            <input type="text" name="title" id="title" placeholder="Enter Title"
                                class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-400 focus:outline-none">
                            @error('title')
                                <span class="text-[red] font-semibold">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-span-12">
                            <label class="block text-gray-700 mb-1 font-semibold" for="description">Description</label>
                           <textarea name="description" id="description" placeholder="Description" class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-400 focus:outline-none"></textarea>
                            @error('description')
                                <span class="text-[red] font-semibold">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
