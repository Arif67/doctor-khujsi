@extends('layouts.admin')
@section('content')
<div class="max-w-3xl mx-auto mt-6 px-4 sm:px-6 lg:px-8">
    <div class="bg-white shadow-lg rounded-lg overflow-hidden">
        <!-- Header -->
        <div class="bg-indigo-600 px-6 py-4">
            <h2 class="text-2xl sm:text-3xl font-bold text-white">{{ $doctor->name }}</h2>
            <p class="text-indigo-200 mt-1 text-sm sm:text-base">{{ $doctor->department?->name ?? '-' }} Department</p>
        </div>

        <!-- Body -->
        <div class="p-6 space-y-6 sm:space-y-8">
            <div class="flex flex-col sm:flex-row items-center sm:items-start sm:space-x-6 space-y-4 sm:space-y-0">
                
                <!-- Photo -->
                @if($doctor->photo)
                    <img src="{{ asset('storage/'.$doctor->photo) }}" 
                         class="w-32 h-32 sm:w-40 sm:h-40 object-cover rounded-full border-2 border-indigo-600 shadow-md">
                @else
                    <div class="w-32 h-32 sm:w-40 sm:h-40 flex items-center justify-center rounded-full bg-gray-200 text-gray-500 font-semibold">
                        No Photo
                    </div>
                @endif

                <!-- Info -->
                <div class="flex-1 space-y-2 sm:space-y-3 w-full">
                    <p class="text-sm sm:text-base"><span class="font-semibold">Email:</span> {{ $doctor->email }}</p>
                    <p class="text-sm sm:text-base"><span class="font-semibold">Phone:</span> {{ $doctor->phone }}</p>
                    <p class="text-sm sm:text-base"><span class="font-semibold">Qualification:</span> {{ $doctor->qualification }}</p>
                    <p class="text-sm sm:text-base"><span class="font-semibold">Specialization:</span> {{ $doctor->specialization }}</p>
                    <p class="text-sm sm:text-base"><span class="font-semibold">Status:</span> 
                        <span class="{{ $doctor->status === 'active' ? 'text-green-600' : 'text-red-600' }}">
                            {{ ucfirst($doctor->status) }}
                        </span>
                    </p>
                </div>
            </div>
        </div>

        <!-- Footer -->
        <div class="px-6 py-4 bg-gray-50 flex justify-end">
            <a href="{{ route('admin.doctors.index') }}" 
               class="px-4 py-2 bg-gray-200 text-gray-700 rounded hover:bg-gray-300 transition">
               Back
            </a>
        </div>
    </div>
</div>
@endsection
