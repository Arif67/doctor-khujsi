@extends('layouts.admin')

@section('content')
<div class="">
    <!-- Card -->
    <div class="bg-white shadow rounded-lg p-6 ">
        <div class="grid grid-cols-1 md:grid-cols-5 gap-3">
            <a href="{{route('admin.app.pages.home')}}" class="w-full text-center text-white py-5 rounded bg-blue-600">
                Home
            </a>
            <a href="" class="w-full text-center text-white py-5 rounded bg-blue-600">
                About Us
            </a>
            <a href="" class="w-full text-center text-white py-5 rounded bg-blue-600">
                Services
            </a>
            <a href="" class="w-full text-center text-white py-5 rounded bg-blue-600">
                Specialists
            </a>
            <a href="" class="w-full text-center text-white py-5 rounded bg-blue-600">
                Blog
            </a>
            <a href="" class="w-full text-center text-white py-5 rounded bg-blue-600">
                Contact
            </a>
            <a href="" class="w-full text-center text-white py-5 rounded bg-blue-600">
                Header
            </a>
             <a href="" class="w-full text-center text-white py-5 rounded bg-blue-600">
                Footer
            </a>
        </div>
    </div>

</div>
@endsection
