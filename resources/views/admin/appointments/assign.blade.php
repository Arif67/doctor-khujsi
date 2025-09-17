@extends('layouts.admin')
@push('styles')
    <style>
        table th, table td {
            padding: 4px 10px;
        }
    </style>
@endpush

@section('content')
<div class="bg-white shadow-sm rounded-lg p-6">
   <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-4 gap-3">
        <h2 class="text-xl font-semibold text-gray-800">Assign Appointment</h2>
    </div>
    <hr class="mb-2">
    <div>
       <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Left Table -->
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <tr>
                        <th class="font-medium text-gray-600 text-left pr-2 whitespace-nowrap">Appointment Id</th>
                        <th class="pr-2">:</th>
                        <td>{{ $appointment->appointment_id }}</td>
                    </tr>
                    <tr>
                        <th class="font-medium text-gray-600 text-left pr-2 whitespace-nowrap">Patient</th>
                        <th class="pr-2">:</th>
                        <td>{{ $appointment->user->first_name }} {{ $appointment->user?->last_name }}</td>
                    </tr>   
                    <tr>
                        <th class="font-medium text-gray-600 text-left pr-2 whitespace-nowrap">Department</th>
                        <th class="pr-2">:</th>
                        <td>{{ $appointment->department->name }}</td>
                    </tr>
                    <tr>
                        <th class="font-medium text-gray-600 text-left pr-2 whitespace-nowrap">Assign Doctors</th>
                        <th class="pr-2">:</th>
                        <td>
                            @if($appointment->serviceHistory->count() > 0)
                                {{ $appointment->serviceHistory->pluck('doctor.name')->implode(', ') }}
                            @else
                                <span class="text-gray-500">No Doctor Assigned</span>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th class="font-medium text-gray-600 text-left pr-2 whitespace-nowrap">Status</th>
                        <th class="pr-2">:</th>
                        <td>
                            @if($appointment->status === 'Pending')
                                <span class="px-2 py-1 text-xs font-semibold text-yellow-700 bg-yellow-100 rounded-sm">Pending</span>
                            @elseif($appointment->status === 'Confirm')
                                <span class="px-2 py-1 text-xs font-semibold text-green-700 bg-green-100 rounded-sm">Confirm</span>
                            @else
                                <span class="px-2 py-1 text-xs font-semibold text-gray-700 bg-gray-100 rounded-sm">{{ $appointment->status }}</span>
                            @endif
                        </td>
                    </tr>
                </table>
            </div>

            <!-- Right Table -->
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <tr>
                        <th class="font-medium text-gray-600 text-left pr-2 whitespace-nowrap">Appointment Date</th>
                        <th class="pr-2">:</th>
                        <td>{{ $appointment->appointment_date }}</td>
                    </tr>
                    <tr>
                        <th class="font-medium text-gray-600 text-left pr-2 whitespace-nowrap">Appointment Time</th>
                        <th class="pr-2">:</th>
                        <td>{{ $appointment->appointment_time }}</td>
                    </tr>
                    <tr>
                        <th class="font-medium text-gray-600 text-left pr-2">Message</th>
                        <th class="pr-2">:</th>
                        <td>{{ $appointment->message ?? 'N/A' }}</td>
                    </tr>
                    <tr>
                        <th class="font-medium text-gray-600 text-left pr-2">Service History</th>
                        <th class="pr-2">:</th>
                        <td class="break-words">
                        <td class="break-words">
                           @if ($appointment->serviceHistory->count() > 0) 
                                {!! $appointment->serviceHistory->map(function($sh) {
                                    $statusClass = match(strtolower($sh->status)) {
                                        'pending' => 'bg-yellow-500 text-white',
                                        'done' => 'bg-green-500 text-white',
                                        'cencel' => 'bg-red-500 text-white',
                                        default => 'bg-gray-500 text-white',
                                    };

                                    return $sh->service->title . 
                                        ' <span class="px-2 py-[2px] rounded-sm text-xs ' . $statusClass . '">' 
                                        . ucfirst($sh->status) . '</span>';
                                })->implode(', ') !!}
                            @else
                                <span class="text-gray-500">No Service History</span>
                            @endif

                        </td>
     
                    </tr>
                </table>
            </div>
        </div>
    </div>

    <hr class="my-4">
    <h2 class="text-xl font-semibold text-gray-800 mb-4">Assign Services & Doctors</h2>

    <form action="{{ route('admin.appointments.assignService', $appointment->id) }}" method="POST">
        @csrf

        <div id="serviceRows" class="space-y-3">
            @if($appointment->serviceHistory->count() > 0)
                @foreach($appointment->serviceHistory as $index => $history)
                    <div class="flex items-center gap-3 service-row">
                        <input type="hidden" name="services[{{ $index }}][id]" value="{{ $history->id }}">

                        <select name="services[{{ $index }}][service_id]" class="border rounded-md px-2 py-1 w-1/2" required>
                            <option value="">-- Select Service --</option>
                            @foreach($services as $service)
                                <option value="{{ $service->id }}" {{ $history->service_id == $service->id ? 'selected' : '' }}>{{ $service->title }}</option>
                            @endforeach
                        </select>

                        <select name="services[{{ $index }}][doctor_id]" class="border rounded-md px-2 py-1 w-1/2" required>
                            <option value="">-- Select Doctor --</option>
                            @foreach($doctors as $doctor)
                                <option value="{{ $doctor->id }}" {{ $history->doctor_id == $doctor->id ? 'selected' : '' }}>{{ $doctor->name }}</option>
                            @endforeach
                        </select>

                         <select name="services[{{ $index }}][status]" class="border rounded-md px-2 py-1 w-1/6">
                            <option value="panding" {{ $history->status == 'panding' ? 'selected' : '' }}>Pending</option>
                            <option value="done" {{ $history->status == 'done' ? 'selected' : '' }}>Done</option>
                            <option value="cencel" {{ $history->status == 'cencel' ? 'selected' : '' }}>Cencel</option>
                        </select>

                        <!-- Date -->
                        <input type="date" name="services[{{ $index }}][service_date]" 
                            value="{{ $history->service_date }}" 
                            class="border rounded-md px-2 py-1 w-1/6">

                        <!-- Time -->
                        <input type="time" name="services[{{ $index }}][service_time]" 
                            value="{{ $history->service_time }}" 
                            class="border rounded-md px-2 py-1 w-1/6">

                        <button type="button" class="removeRow bg-red-500 text-white px-2 py-1 rounded-sm">
                            <i class="fas fa-trash"></i>
                        </button>
                    </div>
                @endforeach
            @else
                <!-- Default Row -->
                <div class="flex items-center gap-3 service-row">
                    <select name="services[0][service_id]" class="border rounded-md px-2 py-1 w-1/2" required>
                        <option value="">-- Select Service --</option>
                        @foreach($services as $service)
                            <option value="{{ $service->id }}">{{ $service->title }}</option>
                        @endforeach
                    </select>

                    <select name="services[0][doctor_id]" class="border rounded-md px-2 py-1 w-1/2" required>
                        <option value="">-- Select Doctor --</option>
                        @foreach($doctors as $doctor)
                            <option value="{{ $doctor->id }}">{{ $doctor->name }}</option>
                        @endforeach
                    </select>

                    <select name="services[0][status]" class="border rounded-md px-2 py-1 w-1/6">
                        <option value="panding">Pending</option>
                        <option value="done">Done</option>
                        <option value="cencel">Cencel</option>
                    </select>

                    

                    <button type="button" class="removeRow bg-red-500 text-white px-2 py-1 rounded-sm">
                        <i class="fas fa-trash"></i>
                    </button>
                </div>
            @endif
        </div>

        <div class="mt-4">
            <button type="button" id="addRow" class="bg-blue-600 text-white px-3 py-1 rounded-sm">+ Add</button>
        </div>

        <div class="mt-6">
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-sm flex items-center gap-2">
                <i class="fas fa-save"></i>
                Save
            </button>
        </div>
    </form>
</div>
@endsection

@push('scripts')
<script>
    let rowIndex = {{ $appointment->serviceHistory->count() ?? 1 }};

    $('#addRow').on('click', function () {
        let newRow = `
            <div class="flex items-center gap-3 service-row mt-2">
                <select name="services[${rowIndex}][service_id]" class="border rounded-md px-2 py-1 w-1/2" required>
                    <option value="">-- Select Service --</option>
                    @foreach($services as $service)
                        <option value="{{ $service->id }}">{{ $service->title }}</option>
                    @endforeach
                </select>

                <select name="services[${rowIndex}][doctor_id]" class="border rounded-md px-2 py-1 w-1/2" required>
                    <option value="">-- Select Doctor --</option>
                    @foreach($doctors as $doctor)
                        <option value="{{ $doctor->id }}">{{ $doctor->name }}</option>
                    @endforeach
                </select>

                <select name="services[${rowIndex}][status]" class="border rounded-md px-2 py-1 w-1/6">
                    <option value="panding">Pending</option>
                    <option value="done">Done</option>
                    <option value="cencel">Cencel</option>
                </select>

                <input type="date" name="services[${rowIndex}][service_date]" class="border rounded-md px-2 py-1 w-1/6">
                <input type="time" name="services[${rowIndex}][service_time]" class="border rounded-md px-2 py-1 w-1/6">

                <button type="button" class="removeRow bg-red-500 text-white px-2 py-1 rounded-sm">
                <i class="fas fa-trash"></i>
                </button>
            </div>
        `;
        $('#serviceRows').append(newRow);
        rowIndex++;
    });

    $(document).on('click', '.removeRow', function () {
        $(this).closest('.service-row').remove();
    });
</script>
@endpush
