<div class="px-4">
    <div class="text-center mb-4">
        @php
            $photo = $user->photo 
                ? asset('storage/'.$user->photo) 
                : asset('assets/img/default.png');
        @endphp
        <img src="{{ $photo }}" class="rounded-circle shadow-sm m-auto" style="width:100px;height:92px;" alt="Patient">
        <h5 class="mt-3 mb-0">{{ $user->name }}</h5>
        <small class="text-muted">Age: {{ $user->age ?? '-' }} | {{ $user->gender }}</small>
    </div>

    <div class="row row-gap-3">
        <div class="col-md-6">
            <strong>First Name:</strong> {{ $user->first_name }}
        </div>
        <div class="col-md-6">
            <strong>Last Name:</strong> {{ $user->last_name }}
        </div>
        <div class="col-md-6">
            <strong>Age:</strong> {{ $user->age ?? '-' }}
        </div>
        <div class="col-md-6">
            <strong>Email:</strong> {{ $user->email ?? '-' }}
        </div>
        <div class="col-md-6">
            <strong>Phone:</strong> {{ $user->phone ?? '-' }}
        </div>
        <div class="col-md-6">
            <strong>Mobile:</strong> {{ $user->mobile ?? '-' }}
        </div>
        <div class="col-md-6">
            <strong>Gender:</strong> {{ $user->gender ?? '-' }}
        </div>
        <div class="col-md-6">
            <strong>Date of Birth:</strong> {{ $user->date_of_birth ?? '-' }}
        </div>
        <div class="col-12">
            <strong>Address:</strong> {{ $user->address ?? '-' }}
        </div>
    </div>

    <hr>

    <div>
        <strong class="d-block mb-2">Reports</strong>
        @forelse ($user->patientReports->sortByDesc('created_at')->take(5) as $report)
            <div class="border rounded p-2 mb-2">
                <div class="fw-semibold">{{ $report->title }}</div>
                <small class="text-muted d-block">
                    {{ $report->report_type ?: 'General report' }}
                    @if ($report->report_date)
                        | {{ $report->report_date->format('d M Y') }}
                    @endif
                </small>
                <a href="{{ $report->file_url }}" target="_blank" class="small">Open file</a>
            </div>
        @empty
            <div class="text-muted">No reports uploaded yet.</div>
        @endforelse
    </div>
</div>
