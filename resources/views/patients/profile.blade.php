@extends('layouts.patient')

@section('title', __('Patient | Profile'))

@section('content')
@php
    $photo = $user->photo
        ? asset('storage/' . $user->photo)
        : asset(match ($user->gender) {
            'Female' => 'assets/img/Female.jpg',
            'Male' => 'assets/img/Male.jpg',
            default => 'assets/img/default.png',
        });
@endphp

<div class="row g-4">
    <div class="col-12 col-xl-4">
        <div class="patient-surface p-4 h-100">
            <div class="text-center">
                <img id="photoPreview" src="{{ $photo }}" class="rounded-circle shadow-sm object-fit-cover" width="120" height="120" alt="Patient">
                <h4 class="mt-3 mb-1">{{ $user->name ?: $user->email }}</h4>
                <div class="patient-muted">{{ $user->email }}</div>
                <span class="badge text-bg-light border mt-3">{{ __('Patient ID: #:id', ['id' => 'P' . $user->id]) }}</span>
            </div>

            <div class="row g-3 mt-4">
                <div class="col-4">
                    <div class="panel-stat text-center p-3">
                        <div class="fw-semibold fs-4">{{ $profileStats['appointments'] }}</div>
                        <small class="patient-muted">{{ __('Appointments') }}</small>
                    </div>
                </div>
                <div class="col-4">
                    <div class="panel-stat text-center p-3">
                        <div class="fw-semibold fs-4">{{ $profileStats['reports'] }}</div>
                        <small class="patient-muted">{{ __('Reports') }}</small>
                    </div>
                </div>
                <div class="col-4">
                    <div class="panel-stat text-center p-3">
                        <div class="fw-semibold fs-4">{{ $profileStats['completion'] }}%</div>
                        <small class="patient-muted">{{ __('Profile Done') }}</small>
                    </div>
                </div>
            </div>

            <hr>

            <div class="d-grid gap-3">
                <div>
                    <div class="small text-uppercase patient-muted">{{ __('Phone') }}</div>
                    <div>{{ $user->phone ?: $user->mobile ?: __('Not added yet') }}</div>
                </div>
                <div>
                    <div class="small text-uppercase patient-muted">{{ __('Blood Group') }}</div>
                    <div>{{ $user->blood ?: __('Not added yet') }}</div>
                </div>
                <div>
                    <div class="small text-uppercase patient-muted">{{ __('Date of Birth') }}</div>
                    <div>{{ $user->date_of_birth?->format('d M Y') ?: __('Not added yet') }}</div>
                </div>
                <div>
                    <div class="small text-uppercase patient-muted">{{ __('Address') }}</div>
                    <div>{{ $user->address ?: __('Not added yet') }}</div>
                </div>
            </div>

            <div class="border rounded-4 p-3 mt-4 bg-white">
                <div class="d-flex justify-content-between align-items-center gap-3 mb-2">
                    <div class="fw-semibold">{{ __('Profile Checklist') }}</div>
                    <span class="badge text-bg-light border">{{ __(':percent% complete', ['percent' => $profileStats['completion']]) }}</span>
                </div>
                @if ($missingProfileItems->isNotEmpty())
                    <div class="patient-muted small mb-2">{{ __('Still missing:') }}</div>
                    <div class="d-flex flex-wrap gap-2">
                        @foreach ($missingProfileItems as $item)
                            <span class="badge rounded-pill text-bg-warning">{{ $item }}</span>
                        @endforeach
                    </div>
                @else
                    <div class="patient-muted small">{{ __('All major patient details are already added.') }}</div>
                @endif
            </div>

            <a href="{{ route('patient.reports.index') }}" class="btn btn-success w-100 mt-4">{{ __('Open Medical Reports') }}</a>
        </div>
    </div>

    <div class="col-12 col-xl-8">
        <div class="patient-surface p-4">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h4 class="mb-1">{{ __('Edit Profile') }}</h4>
                    <p class="patient-muted mb-0">{{ __('Keep patient information current so hospitals can review the right details.') }}</p>
                </div>
            </div>

            <form action="{{ route('patient.profile.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="row g-3">
                    <div class="col-md-6">
                        <label for="photo" class="form-label">{{ __('Photo') }}</label>
                        <input type="file" name="photo" id="photo" class="form-control" accept="image/*">
                    </div>

                    <div class="col-md-6">
                        <label for="blood" class="form-label">{{ __('Blood Group') }}</label>
                        <input type="text" name="blood" id="blood" class="form-control" value="{{ old('blood', $user->blood) }}" placeholder="{{ __('A+, O-, AB+') }}">
                    </div>

                    <div class="col-md-6">
                        <label for="first_name" class="form-label">{{ __('First Name') }}</label>
                        <input type="text" name="first_name" id="first_name" class="form-control" value="{{ old('first_name', $user->first_name) }}" required>
                    </div>

                    <div class="col-md-6">
                        <label for="last_name" class="form-label">{{ __('Last Name') }}</label>
                        <input type="text" name="last_name" id="last_name" class="form-control" value="{{ old('last_name', $user->last_name) }}" required>
                    </div>

                    <div class="col-md-6">
                        <label for="age" class="form-label">{{ __('Age') }}</label>
                        <input type="text" name="age" id="age" class="form-control" value="{{ old('age', $user->age) }}">
                    </div>

                    <div class="col-md-6">
                        <label for="gender" class="form-label">{{ __('Gender') }}</label>
                        <select name="gender" id="gender" class="form-select">
                            <option value="">{{ __('Select gender') }}</option>
                            <option value="Male" @selected(old('gender', $user->gender) === 'Male')>{{ __('Male') }}</option>
                            <option value="Female" @selected(old('gender', $user->gender) === 'Female')>{{ __('Female') }}</option>
                            <option value="Other" @selected(old('gender', $user->gender) === 'Other')>{{ __('Other') }}</option>
                        </select>
                    </div>

                    <div class="col-md-6">
                        <label for="email" class="form-label">{{ __('Email') }}</label>
                        <input type="email" name="email" id="email" class="form-control" value="{{ old('email', $user->email) }}">
                    </div>

                    <div class="col-md-6">
                        <label for="date_of_birth" class="form-label">{{ __('Date of Birth') }}</label>
                        <input type="date" name="date_of_birth" id="date_of_birth" class="form-control" value="{{ old('date_of_birth', optional($user->date_of_birth)->format('Y-m-d')) }}">
                    </div>

                    <div class="col-md-6">
                        <label for="phone" class="form-label">{{ __('Phone') }}</label>
                        <input type="text" name="phone" id="phone" class="form-control" value="{{ old('phone', $user->phone) }}">
                    </div>

                    <div class="col-md-6">
                        <label for="mobile" class="form-label">{{ __('Mobile') }}</label>
                        <input type="text" name="mobile" id="mobile" class="form-control" value="{{ old('mobile', $user->mobile) }}">
                    </div>

                    <div class="col-12">
                        <label for="address" class="form-label">{{ __('Address') }}</label>
                        <textarea name="address" id="address" class="form-control" rows="3">{{ old('address', $user->address) }}</textarea>
                    </div>
                </div>

                <div class="d-flex justify-content-end mt-4">
                    <button type="submit" class="btn btn-success px-4">{{ __('Save Changes') }}</button>
                </div>
            </form>
        </div>

        <div class="patient-surface p-4 mt-4">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <div>
                    <h5 class="mb-1">{{ __('Recent Uploaded Reports') }}</h5>
                    <p class="patient-muted mb-0">{{ __('Latest files attached to your patient profile.') }}</p>
                </div>
                <a href="{{ route('patient.reports.index') }}" class="btn btn-sm btn-outline-secondary">{{ __('Manage reports') }}</a>
            </div>

            <div class="table-responsive">
                <table class="table align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>{{ __('Title') }}</th>
                            <th>{{ __('Type') }}</th>
                            <th>{{ __('Date') }}</th>
                            <th>{{ __('File') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($recentReports as $report)
                            <tr>
                                <td class="fw-semibold">{{ $report->title }}</td>
                                <td>{{ $report->report_type ?: __('General report') }}</td>
                                <td>{{ $report->report_date?->format('d M Y') ?: __('N/A') }}</td>
                                <td>
                                    <a href="{{ route('patient.reports.download', $report) }}" class="btn btn-sm btn-outline-success">
                                        {{ $report->file_name }}
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center py-4 patient-muted">{{ __('No reports uploaded yet.') }}</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    $(function () {
        $('#photo').on('change', function () {
            const file = this.files[0];

            if (!file) {
                return;
            }

            const reader = new FileReader();
            reader.onload = function (event) {
                $('#photoPreview').attr('src', event.target.result);
            };
            reader.readAsDataURL(file);
        });
    });
</script>
@endpush
