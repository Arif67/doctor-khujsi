@extends('layouts.patient')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-12">

            <!-- Patient Profile Card -->
            <div class="card shadow-sm border-0 rounded-3">
                <div class="card-header bg-white border-bottom d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Patient Profile</h5>
                    <span class="badge bg-primary">ID: #P12345</span>
                </div>
                <div class="card-body">
                    <div class="text-center mb-4">
                        <img src="https://randomuser.me/api/portraits/women/44.jpg" class="rounded-circle shadow-sm" alt="Patient">
                        <h5 class="mt-3 mb-0">John Doe</h5>
                        <small class="text-muted">Age: 35 | Male</small>
                    </div>

                    <!-- Update Form -->
                    <form action="" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="row row-gap-3">
                            <div class="col-md-6">
                                <label class="form-label">Full Name</label>
                                <input type="text" name="name" class="form-control" value="John Doe" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Email</label>
                                <input type="email" name="email" class="form-control" value="john@example.com">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Phone</label>
                                <input type="text" name="phone" class="form-control" value="+880123456789">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Gender</label>
                                <select name="gender" class="form-select">
                                    <option value="Male" selected>Male</option>
                                    <option value="Female">Female</option>
                                    <option value="Other">Other</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Date of Birth</label>
                                <input type="date" name="dob" class="form-control" value="1990-05-12">
                            </div>

                            <div class="col-12">
                                <label class="form-label">Address</label>
                                <textarea name="address" class="form-control" rows="2">123 Main Street, Dhaka</textarea>
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
