@extends('layouts.admin')

@section('content')
<div class="bg-white rounded-2xl shadow p-6">
    <div class="flex justify-between items-center mb-4">
        <div>
            <h1 class="text-2xl font-semibold">Hospital Gallery</h1>
            <p class="text-sm text-slate-500 mt-1">User side er hospital details page e ei gallery dekhabe.</p>
        </div>
        <a href="{{ route('admin.hospital-galleries.create') }}" class="inline-flex items-center px-5 py-2 bg-indigo-600 text-white text-sm font-medium rounded shadow hover:bg-indigo-700 transition">
            + Add Image
        </a>
    </div>
    <hr class="mb-5">

    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-5">
        @forelse($galleries as $gallery)
            <div class="border rounded-2xl p-4 bg-slate-50">
                <img src="{{ asset('storage/' . $gallery->image) }}" alt="{{ $gallery->title ?: 'Hospital gallery image' }}" class="w-full h-56 object-cover rounded-xl mb-4">
                <h3 class="font-semibold text-slate-800">{{ $gallery->title ?: 'Untitled image' }}</h3>
                <div class="text-sm text-slate-500 mt-1">{{ $gallery->created_at?->format('d M Y, h:i A') }}</div>
                <div class="flex gap-2 mt-4">
                    <a href="{{ route('admin.hospital-galleries.edit', $gallery->id) }}" class="inline-flex items-center px-3 py-2 bg-indigo-600 text-white text-sm font-medium rounded shadow hover:bg-indigo-700 transition">
                        <i class="fas fa-edit"></i>
                    </a>
                    <form action="{{ route('admin.hospital-galleries.destroy', $gallery->id) }}" method="POST" onsubmit="return confirm('Delete this gallery image?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="px-3 py-2 bg-red-600 text-white rounded hover:bg-red-700">
                            <i class="fas fa-trash"></i>
                        </button>
                    </form>
                </div>
            </div>
        @empty
            <div class="col-span-full">
                <div class="alert alert-info mb-0">No gallery image added yet.</div>
            </div>
        @endforelse
    </div>
</div>
@endsection
