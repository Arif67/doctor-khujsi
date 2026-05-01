@extends('layouts.patient')

@section('title', __('Patient | Favorite Doctors'))

@section('content')
<div class="patient-surface p-4">
    <div class="d-flex flex-column flex-lg-row justify-content-between align-items-lg-center gap-3 mb-4">
        <div>
            <h4 class="mb-1">{{ __('Favorite Doctors') }}</h4>
            <p class="patient-muted mb-0">{{ __('Keep your preferred specialists in one list for faster follow-up.') }}</p>
        </div>
        <a href="{{ route('app.specialists') }}" class="btn btn-outline-success">{{ __('Browse Doctors') }}</a>
    </div>

    <div class="row g-4">
        @forelse ($items as $item)
            @php
                $doctor = $item->doctor;
                $photo = $doctor?->photo ? asset('storage/' . $doctor->photo) : asset('assets/img/doctore.png');
            @endphp
            <div class="col-md-6 col-xl-4">
                <div class="border rounded-4 p-4 h-100 bg-white">
                    <div class="d-flex align-items-center gap-3">
                        <img src="{{ $photo }}" class="rounded-circle object-fit-cover" width="72" height="72" alt="{{ $doctor?->name }}">
                        <div>
                            <h6 class="fw-semibold mb-1">{{ $doctor?->name ?? __('Unknown doctor') }}</h6>
                            <div class="patient-muted small">{{ $doctor?->department?->name ?? __('Department not assigned') }}</div>
                            <div class="patient-muted small">{{ $doctor?->speciality ?? __('Speciality not added') }}</div>
                        </div>
                    </div>

                    <div class="patient-muted small mt-3">
                        {{ __('Hospital') }}:
                        {{ $doctor?->owner?->hospital_name ?: ($doctor?->owner?->name ?: __('N/A')) }}
                    </div>

                    <div class="d-flex gap-2 mt-4">
                        @if ($doctor)
                            <a href="{{ route('app.doctor-profile', [$doctor, \Illuminate\Support\Str::slug($doctor->name)]) }}" class="btn btn-sm btn-success">{{ __('View Profile') }}</a>
                        @endif
                        <button type="button" class="btn btn-sm btn-outline-danger favorite-toggle" data-id="{{ $doctor?->id }}">
                            {{ __('Remove') }}
                        </button>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="border rounded-4 p-5 text-center patient-muted">
                    {{ __('No favorite doctors added yet.') }}
                </div>
            </div>
        @endforelse
    </div>
</div>
@endsection

@push('scripts')
<script>
    $(function () {
        $('.favorite-toggle').on('click', function () {
            const button = $(this);
            const doctorId = button.data('id');

            $.post("{{ url('/patient/favorite-doctore') }}/" + doctorId, {
                _token: "{{ csrf_token() }}"
            }).done(function () {
                button.closest('.col-md-6').remove();
            });
        });
    });
</script>
@endpush
