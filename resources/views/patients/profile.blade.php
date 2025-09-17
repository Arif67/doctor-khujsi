@extends('layouts.patient')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-12">
            <!-- Patient Profile Card -->
            <div class="card shadow-sm border-0 rounded-3">
                <div class="card-header bg-white border-bottom d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Patient Profile</h5>
                    <span class="badge bg-primary">ID: #P{{ $user->id }}</span>
                </div>
                <div class="card-body">
                    <div class="text-center mb-4">
                        @php
                            $photo = $user->photo 
                                ? asset('storage/'.$user->photo) 
                                : asset('assets/img/' . $user->gender . '.jpg');
                        @endphp
                        <img id="photoPreview" src="{{ $photo }}" class="rounded-circle shadow-sm" width="120" height="120" alt="Patient">
                        <h5 class="mt-3 mb-0">{{ $user->name }}</h5>
                        <small class="text-muted">Age: {{ $user->age ?? '-' }} | {{ $user->gender }}</small>
                    </div>

                    <!-- Update Form -->
                    <form action="{{route('patient.profile.update')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="row row-gap-3">
                            <div class="col-md-6">
                                <label for="photo" class="form-label">Photo:</label>
                                <input type="file" name="photo" id="photo" class="form-control">
                            </div>
                            <div class="col-md-6">
                                <label for="first_name" class="form-label">First Name</label>
                                <input type="text" name="first_name" class="form-control" value="{{ $user->first_name }}" required>
                            </div>
                               <div class="col-md-6">
                                <label for="last_name" class="form-label">Last Name</label>
                                <input type="text" name="last_name" class="form-control" value="{{ $user->last_name }}">
                            </div>
                            <div class="col-md-6">
                                <label for="age" class="form-label">Age</label>
                                <input type="text" name="age" class="form-control" value="{{ $user->age }}">
                            </div>
                            <div class="col-md-6">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" name="email" class="form-control" value="{{ $user->email }}">
                            </div>
                            <div class="col-md-6">
                                <label for="phone" class="form-label">Phone</label>
                                <input type="text" name="phone" class="form-control" value="{{ $user->phone }}">
                            </div>
                            <div class="col-md-6">
                                <label for="mobile" class="form-label">Mobile</label>
                                <input type="text" name="mobile" class="form-control" value="{{ $user->mobile }}">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Gender</label>
                                <select name="gender" class="form-select">
                                    <option value="Male" {{ $user->gender == 'Male' ? 'selected' : '' }}>Male</option>
                                    <option value="Female" {{ $user->gender == 'Female' ? 'selected' : '' }}>Female</option>
                                    <option value="Other" {{ $user->gender == 'Other' ? 'selected' : '' }}>Other</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="date_of_birth" class="form-label">Date of Birth</label>
                                <input type="date" name="date_of_birth" class="form-control" value="{{ $user->date_of_birth }}">
                            </div>

                            <div class="col-12">
                                <label class="form-label">Address</label>
                                <textarea name="address" class="form-control" rows="2">{{ $user->address }}</textarea>
                            </div>
                        </div>   
                        <div class="d-flex justify-content-end mt-4">
                            <button type="submit" class="btn btn-success px-4">Update</button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function(){
            $("#photo").change(function(e){
                let reader = new FileReader();
                reader.onload = function(e){
                    $("#photoPreview").attr("src", e.target.result);
                }
                reader.readAsDataURL(this.files[0]);
            });
        });
    </script>
@endpush
