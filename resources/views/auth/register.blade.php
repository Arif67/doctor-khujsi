@extends('frontend.layout.masterlayout')

@section('title', 'Register - Hospital Management')

@section('styles')
    {{-- Bootstrap 5 --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://kit.fontawesome.com/your-fontawesome-kit.js" crossorigin="anonymous"></script>

    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }

        .register-card {
            border-radius: 20px;
            overflow: hidden;
        }

        .register-img {
            object-fit: cover;
            height: 100%;
        }

        .form-container {
            padding: 40px;
        }

        .form-title {
            font-size: 28px;
            font-weight: 600;
            margin-bottom: 30px;
            color: #0d6efd;
        }

        .btn-info-custom {
            background-color: #0d6efd;
            color: #fff;
            font-weight: 600;
        }

        .btn-info-custom:hover {
            background-color: #0b5ed7;
        }

        .terms-text a {
            color: #0d6efd;
            text-decoration: none;
        }

        .terms-text a:hover {
            text-decoration: underline;
        }

        @media(max-width: 992px){
            .register-img {
                display: none;
            }
        }
    </style>
@endsection

@section('content')
<div class="container">
    <div class="card register-card shadow-lg">
        <div class="row g-0">
            {{-- Left Image --}}
            <div class="col-lg-5 d-none d-lg-block">
                <img src="{{asset('assets/img/register.jpg')}}" 
                     class="register-img " alt="Hospital Image">
            </div>

            {{-- Form --}}
            <div class="col-lg-7">
                <div class="form-container">
                    {{-- Close button --}}
                    <button class="btn-close float-end mb-3" onclick="window.history.back()"></button>

                    {{-- Title --}}
                    <h3 class="form-title">Create Your Account</h3>

                    {{-- Success --}}
                    @if(session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    {{-- Errors --}}
                    @if($errors->any())
                        <div class="alert alert-danger">
                            @foreach($errors->all() as $error)
                                <div>{{ $error }}</div>
                            @endforeach
                        </div>
                    @endif

                    <form action="{{ route('register') }}" method="POST">
                        @csrf
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label for="first_name" class="form-label">First Name <span class="text-danger">*</span></label>
                                <input type="text" id="first_name" name="first_name" class="form-control" value="{{ old('first_name') }}" required>
                            </div>
                            <div class="col-md-6">
                                <label for="last_name" class="form-label">Last Name <span class="text-danger">*</span></label>
                                <input type="text" id="last_name" name="last_name" class="form-control" value="{{ old('last_name') }}" required>
                            </div>
                        </div>

                        <div class="mt-3">
                            <label for="email" class="form-label">Email Address <span class="text-danger">*</span></label>
                            <input type="email" id="email" name="email" class="form-control" value="{{ old('email') }}" required>
                        </div>

                        <div class="row g-3 mt-1">
                            <div class="col-md-6">
                                <label for="phone" class="form-label">Phone Number <span class="text-danger">*</span></label>
                                <input type="tel" id="phone" name="phone" class="form-control" value="{{ old('phone') }}" required>
                            </div>
                            <div class="col-md-6">
                                <label for="date_of_birth" class="form-label">Date of Birth</label>
                                <input type="date" id="date_of_birth" name="date_of_birth" class="form-control" value="{{ old('date_of_birth') }}">
                            </div>
                        </div>

                        <div class="row g-3 mt-1">
                            <div class="col-md-6">
                                <label for="gender" class="form-label">Gender</label>
                                <select id="gender" name="gender" class="form-select">
                                    <option value="">Select Gender</option>
                                    <option value="male" {{ old('gender') == 'male' ? 'selected' : '' }}>Male</option>
                                    <option value="female" {{ old('gender') == 'female' ? 'selected' : '' }}>Female</option>
                                    <option value="other" {{ old('gender') == 'other' ? 'selected' : '' }}>Other</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="blood_group" class="form-label">Blood Group</label>
                                <select id="blood_group" name="blood_group" class="form-select">
                                    <option value="">Select Blood Group</option>
                                    @foreach(['A+','A-','B+','B-','AB+','AB-','O+','O-'] as $bg)
                                        <option value="{{ $bg }}" {{ old('blood_group') == $bg ? 'selected' : '' }}>{{ $bg }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="mt-3">
                            <label for="address" class="form-label">Address</label>
                            <input type="text" id="address" name="address" class="form-control" value="{{ old('address') }}" placeholder="Enter your full address">
                        </div>

                        <div class="row g-3 mt-1">
                            <div class="col-md-6">
                                <label for="password" class="form-label">Password <span class="text-danger">*</span></label>
                                <input type="password" id="password" name="password" class="form-control" required>
                            </div>
                            <div class="col-md-6">
                                <label for="password_confirmation" class="form-label">Confirm Password <span class="text-danger">*</span></label>
                                <input type="password" id="password_confirmation" name="password_confirmation" class="form-control" required>
                            </div>
                        </div>

                        <div class="form-check mt-3">
                            <input type="checkbox" id="terms" name="terms" class="form-check-input" required {{ old('terms') ? 'checked' : '' }}>
                            <label for="terms" class="form-check-label terms-text">
                                I agree to the <a href="#">Terms of Service</a> and <a href="#">Privacy Policy</a>
                            </label>
                        </div>

                        <div class="d-grid mt-4">
                            <button type="submit" class="btn btn-info-custom">Create Account</button>
                        </div>
                    </form>

                    <p class="text-center mt-4 mb-0">
                        Already have an account? <a href="{{ route('login') }}" class="fw-semibold text-info text-decoration-none">Sign in here</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
