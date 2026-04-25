@extends('layouts.admin')

@section('content')
<div class="bg-white shadow-lg rounded-lg p-6">
    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-3 mb-5">
        <div>
            <h2 class="text-2xl font-semibold text-gray-800">Booking Details</h2>
            <p class="text-sm text-gray-500 mt-1">Patient, doctor, hospital ar request info ek sathe.</p>
        </div>
        <div class="flex gap-3">
            <a href="{{ route('admin.doctor-bookings.print', ['q' => $doctorBooking->patient_name]) }}" target="_blank" class="inline-flex items-center px-4 py-2 bg-emerald-600 text-white text-sm font-medium rounded shadow hover:bg-emerald-700 transition">
                Print Report
            </a>
            <a href="{{ route('admin.doctor-bookings.index') }}" class="inline-flex items-center px-4 py-2 bg-slate-700 text-white text-sm font-medium rounded shadow hover:bg-slate-800 transition">
                Back To List
            </a>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <div class="border rounded-lg p-5">
            <h3 class="text-lg font-semibold text-gray-800 mb-4">Patient Info</h3>
            <div class="space-y-3 text-sm text-gray-700">
                <div><strong>Name:</strong> {{ $doctorBooking->patient_name }}</div>
                <div><strong>Phone:</strong> {{ $doctorBooking->patient_phone }}</div>
                <div><strong>Email:</strong> {{ $doctorBooking->patient_email ?: '-' }}</div>
                <div><strong>Age:</strong> {{ $doctorBooking->patient_age }}</div>
                <div>
                    <strong>Status:</strong>
                    <span class="px-2 py-1 rounded text-xs {{ $doctorBooking->status === 'confirmed' ? 'bg-green-100 text-green-800' : ($doctorBooking->status === 'cancelled' ? 'bg-red-100 text-red-800' : 'bg-yellow-100 text-yellow-800') }}">
                        {{ ucfirst($doctorBooking->status) }}
                    </span>
                </div>
                <div><strong>Submitted:</strong> {{ $doctorBooking->created_at?->format('d M Y, h:i A') }}</div>
            </div>
        </div>

        <div class="border rounded-lg p-5">
            <h3 class="text-lg font-semibold text-gray-800 mb-4">Doctor And Hospital</h3>
            <div class="space-y-3 text-sm text-gray-700">
                <div><strong>Doctor:</strong> {{ $doctorBooking->doctor?->name ?? 'Deleted doctor' }}</div>
                <div><strong>Speciality:</strong> {{ $doctorBooking->doctor?->speciality ?: ($doctorBooking->doctor?->department?->name ?? '-') }}</div>
                <div><strong>Hospital:</strong> {{ $doctorBooking->doctor?->owner?->hospital_name ?? $doctorBooking->hospitalOwner?->hospital_name ?? '-' }}</div>
                <div><strong>Hospital Email:</strong> {{ $doctorBooking->doctor?->owner?->email ?? $doctorBooking->hospitalOwner?->email ?? '-' }}</div>
                <div><strong>Owner:</strong> {{ $doctorBooking->doctor?->owner?->name ?: ($doctorBooking->hospitalOwner?->name ?: '-') }}</div>
            </div>
        </div>
    </div>

    <div class="border rounded-lg p-5 mt-6">
        <h3 class="text-lg font-semibold text-gray-800 mb-4">Notes</h3>
        <form action="{{ route('admin.doctor-bookings.update-notes', $doctorBooking) }}" method="POST">
            @csrf
            @method('PATCH')
            <textarea name="notes" rows="4" class="w-full border rounded p-3 text-sm text-gray-700" placeholder="Write internal note for this booking">{{ old('notes', $doctorBooking->notes) }}</textarea>
            <button type="submit" class="mt-3 px-4 py-2 bg-indigo-600 text-white text-sm font-medium rounded shadow hover:bg-indigo-700 transition">
                Save Notes
            </button>
        </form>
    </div>

    <div class="border rounded-lg p-5 mt-6">
        <h3 class="text-lg font-semibold text-gray-800 mb-4">Quick Status Update</h3>
        <div class="flex flex-wrap gap-3">
            @foreach (['pending', 'confirmed', 'cancelled'] as $status)
                @if ($doctorBooking->status !== $status)
                    <form action="{{ route('admin.doctor-bookings.update-status', $doctorBooking) }}" method="POST">
                        @csrf
                        @method('PATCH')
                        <input type="hidden" name="status" value="{{ $status }}">
                        <textarea name="status_reason" rows="2" class="w-full border rounded p-2 text-sm text-gray-700 mb-2" placeholder="Optional reason for this status change"></textarea>
                        <button type="submit" class="px-4 py-2 rounded text-white text-sm font-medium shadow {{ $status === 'confirmed' ? 'bg-green-600 hover:bg-green-700' : ($status === 'cancelled' ? 'bg-red-600 hover:bg-red-700' : 'bg-yellow-500 hover:bg-yellow-600') }}">
                            Mark {{ ucfirst($status) }}
                        </button>
                    </form>
                @endif
            @endforeach
        </div>
    </div>

    <div class="border rounded-lg p-5 mt-6">
        <h3 class="text-lg font-semibold text-gray-800 mb-4">Status History</h3>
        <div class="space-y-3">
            @forelse ($doctorBooking->statusHistory as $history)
                <div class="border rounded-lg px-4 py-3 text-sm text-gray-700">
                    <div>
                        <strong>{{ ucfirst($history->from_status ?: 'none') }}</strong>
                        to
                        <strong>{{ ucfirst($history->to_status) }}</strong>
                    </div>
                    <div class="text-gray-500 mt-1">
                        By {{ $history->changedBy?->name ?: 'System' }} at {{ $history->created_at?->format('d M Y, h:i A') }}
                    </div>
                    @if ($history->reason)
                        <div class="text-gray-700 mt-2">
                            <strong>Reason:</strong> {{ $history->reason }}
                        </div>
                    @endif
                </div>
            @empty
                <div class="text-sm text-gray-500">No status changes yet.</div>
            @endforelse
        </div>
    </div>
</div>
@endsection
