@extends('layouts.admin')

@section('content')
<div class="bg-white shadow rounded-lg p-6">
    <div class="mb-6 border-b pb-4">
        <h1 class="text-2xl font-bold text-gray-800">{{ $blog->title }}</h1>
        <p class="text-sm text-gray-500 mt-1">
            Category: <span class="font-medium text-indigo-600">{{ $blog->category->name ?? 'N/A' }}</span>
        </p>
        <p class="text-sm text-gray-500 mt-1">
            Status: 
            @if($blog->status == 'published')
                <span class="px-2 py-1 bg-green-100 text-green-700 text-xs rounded">Published</span>
            @else
                <span class="px-2 py-1 bg-yellow-100 text-yellow-700 text-xs rounded">Draft</span>
            @endif
        </p>
        <p class="text-xs text-gray-400 mt-1">Created: {{ $blog->created_at->format('d M Y, h:i A') }}</p>
    </div>

    <!-- Images -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
        @if($blog->thumbnail_image)
            <div>
                <h2 class="font-semibold text-gray-700 mb-2">Thumbnail</h2>
                <img src="{{ asset('storage/'.$blog->thumbnail_image) }}" class="w-full h-48 object-cover rounded border">
            </div>
        @endif

        @if($blog->featured_image)
            <div>
                <h2 class="font-semibold text-gray-700 mb-2">Featured Image</h2>
                <img src="{{ asset('storage/'.$blog->featured_image) }}" class="w-full h-48 object-cover rounded border">
            </div>
        @endif
    </div>

    <!-- Short Description -->
    <div class="mb-6">
        <h2 class="font-semibold text-gray-700 mb-2">Short Description :</h2>
        <p class="text-gray-600">{{ $blog->short_description }}</p>
    </div>

    <!-- Blog Body -->
    <div class="mb-6">
        <h2 class="font-semibold text-gray-700 mb-4">Blog Content :</h2>
        <div class="prose prose-indigo max-w-none">
            {!! $blog->content !!}
        </div>
    </div>

    <!-- SEO Section -->
    <div class="mb-6 bg-gray-50 p-4 rounded border">
        <h2 class="font-semibold text-gray-700 mb-2">SEO Information :</h2>
        <p><span class="font-medium">Meta Title:</span> {{ $blog->meta_title ?? 'N/A' }}</p>
        <p><span class="font-medium">Meta Description:</span> {{ $blog->meta_description ?? 'N/A' }}</p>
        <p><span class="font-medium">Meta Keywords:</span> {{ $blog->meta_keywords ?? 'N/A' }}</p>
    </div>

    <!-- Action Buttons -->
    <div class="flex gap-3">
        <a href="{{ route('admin.blogs.edit', $blog->id) }}" 
           class="px-4 py-2 bg-indigo-600 text-white text-sm rounded hover:bg-indigo-700">Edit</a>
        <a href="{{ route('admin.blogs.index') }}" 
           class="px-4 py-2 flex flex-row gap-2 items-center bg-gray-300 text-gray-700 text-sm rounded hover:bg-gray-400">
            <i class="fas fa-arrow-left"></i>Back
        </a>
    </div>
</div>
@endsection
