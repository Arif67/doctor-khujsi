@extends('layouts.admin')
@section('content')
 <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
    <!-- Doctors -->
    <div class="bg-white shadow rounded-lg p-6 flex items-center justify-between">
        <div>
            <h2 class="text-gray-500 font-medium">Doctors</h2>
            <p class="text-2xl font-bold text-gray-800">120</p>
        </div>
        <div class="text-blue-500 text-3xl">
            <i class="fas fa-user-md"></i>
        </div>
    </div>

    <!-- Patients -->
    <div class="bg-white shadow rounded-lg p-6 flex items-center justify-between">
        <div>
            <h2 class="text-gray-500 font-medium">Patients</h2>
            <p class="text-2xl font-bold text-gray-800">350</p>
        </div>
        <div class="text-green-500 text-3xl">
            <i class="fas fa-procedures"></i>
        </div>
    </div>

    <!-- Appointments -->
    <div class="bg-white shadow rounded-lg p-6 flex items-center justify-between">
        <div>
            <h2 class="text-gray-500 font-medium">Appointments</h2>
            <p class="text-2xl font-bold text-gray-800">75</p>
        </div>
        <div class="text-yellow-500 text-3xl">
            <i class="fas fa-calendar-check"></i>
        </div>
    </div>

    <!-- Departments -->
    <div class="bg-white shadow rounded-lg p-6 flex items-center justify-between">
        <div>
            <h2 class="text-gray-500 font-medium">Departments</h2>
            <p class="text-2xl font-bold text-gray-800">12</p>
        </div>
        <div class="text-red-500 text-3xl">
            <i class="fas fa-hospital"></i>
        </div>
    </div>

    <!-- Category -->
    <div class="bg-white shadow rounded-lg p-6 flex items-center justify-between">
        <div>
            <h2 class="text-gray-500 font-medium">Category</h2>
            <p class="text-2xl font-bold text-gray-800">20</p>
        </div>
        <div class="text-purple-500 text-3xl">
            <i class="fas fa-tags"></i>
        </div>
    </div>

    <!-- Blog -->
    <div class="bg-white shadow rounded-lg p-6 flex items-center justify-between">
        <div>
            <h2 class="text-gray-500 font-medium">Blog Posts</h2>
            <p class="text-2xl font-bold text-gray-800">45</p>
        </div>
        <div class="text-indigo-500 text-3xl">
            <i class="fas fa-blog"></i>
        </div>
    </div>

    <!-- Services -->
    <div class="bg-white shadow rounded-lg p-6 flex items-center justify-between">
        <div>
            <h2 class="text-gray-500 font-medium">Services</h2>
            <p class="text-2xl font-bold text-gray-800">18</p>
        </div>
        <div class="text-teal-500 text-3xl">
            <i class="fas fa-concierge-bell"></i>
        </div>
    </div>

    <!-- Users -->
    <div class="bg-white shadow rounded-lg p-6 flex items-center justify-between">
        <div>
            <h2 class="text-gray-500 font-medium">Users</h2>
            <p class="text-2xl font-bold text-gray-800">200</p>
        </div>
        <div class="text-pink-500 text-3xl">
            <i class="fas fa-users"></i>
        </div>
    </div>

    <!-- Roles -->
    <div class="bg-white shadow rounded-lg p-6 flex items-center justify-between">
        <div>
            <h2 class="text-gray-500 font-medium">Roles</h2>
            <p class="text-2xl font-bold text-gray-800">5</p>
        </div>
        <div class="text-orange-500 text-3xl">
            <i class="fas fa-user-tag"></i>
        </div>
    </div>

    <!-- Permission -->
    <div class="bg-white shadow rounded-lg p-6 flex items-center justify-between">
        <div>
            <h2 class="text-gray-500 font-medium">Permissions</h2>
            <p class="text-2xl font-bold text-gray-800">30</p>
        </div>
        <div class="text-gray-700 text-3xl">
            <i class="fas fa-key"></i>
        </div>
    </div>

</div>

<!-- Table section -->
<div class="mt-8 bg-white shadow rounded-lg p-6">
    <h3 class="text-xl font-semibold text-gray-700 mb-4">Recent Appointments</h3>
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
            <thead>
                <tr class="bg-gray-50">
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Patient</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Doctor</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Department</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Date</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap">John Doe</td>
                    <td class="px-6 py-4 whitespace-nowrap">Dr. Smith</td>
                    <td class="px-6 py-4 whitespace-nowrap">Cardiology</td>
                    <td class="px-6 py-4 whitespace-nowrap">2025-09-07</td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Confirmed</span>
                    </td>
                </tr>
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap">Jane Doe</td>
                    <td class="px-6 py-4 whitespace-nowrap">Dr. Adams</td>
                    <td class="px-6 py-4 whitespace-nowrap">Neurology</td>
                    <td class="px-6 py-4 whitespace-nowrap">2025-09-08</td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">Pending</span>
                    </td>
                </tr>
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap">Mark Twain</td>
                    <td class="px-6 py-4 whitespace-nowrap">Dr. Brown</td>
                    <td class="px-6 py-4 whitespace-nowrap">Orthopedics</td>
                    <td class="px-6 py-4 whitespace-nowrap">2025-09-09</td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">Cancelled</span>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>  
@endsection
