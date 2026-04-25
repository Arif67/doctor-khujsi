@extends('layouts.admin')

@section('content')
<div class="bg-white shadow-lg rounded-lg p-6">
    <div class="flex items-center justify-between mb-5">
        <div>
            <h2 class="text-2xl font-semibold text-gray-800">Doctor Analytics</h2>
            <p class="text-sm text-gray-500 mt-1">Doctor-wise booking volume ar status breakdown.</p>
        </div>
        <a href="{{ route('admin.doctor-bookings.index') }}" class="inline-flex items-center px-4 py-2 bg-slate-700 text-white text-sm font-medium rounded shadow hover:bg-slate-800 transition">
            Back To Bookings
        </a>
    </div>

    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200 table-auto">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-3 py-2 text-left text-xs sm:text-sm font-medium text-gray-500 uppercase tracking-wider">Doctor</th>
                    <th class="px-3 py-2 text-left text-xs sm:text-sm font-medium text-gray-500 uppercase tracking-wider">Hospital</th>
                    <th class="px-3 py-2 text-left text-xs sm:text-sm font-medium text-gray-500 uppercase tracking-wider">Total</th>
                    <th class="px-3 py-2 text-left text-xs sm:text-sm font-medium text-gray-500 uppercase tracking-wider">Pending</th>
                    <th class="px-3 py-2 text-left text-xs sm:text-sm font-medium text-gray-500 uppercase tracking-wider">Confirmed</th>
                    <th class="px-3 py-2 text-left text-xs sm:text-sm font-medium text-gray-500 uppercase tracking-wider">Cancelled</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse ($doctorAnalytics as $item)
                    <tr>
                        <td class="px-3 py-3">{{ $item->doctor_name }}</td>
                        <td class="px-3 py-3">{{ $item->hospital_name }}</td>
                        <td class="px-3 py-3 font-semibold">{{ $item->total_bookings }}</td>
                        <td class="px-3 py-3 text-yellow-700">{{ $item->pending_count }}</td>
                        <td class="px-3 py-3 text-green-700">{{ $item->confirmed_count }}</td>
                        <td class="px-3 py-3 text-red-700">{{ $item->cancelled_count }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-3 py-6 text-center text-gray-500">No doctor analytics data available yet.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
