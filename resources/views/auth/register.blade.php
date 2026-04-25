@extends('frontend.layout.masterlayout')

@section('title', 'Hospital Registration')

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
                    <h3 class="form-title">Register Your Hospital</h3>

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
                                <label for="hospital_name" class="form-label">Hospital Name <span class="text-danger">*</span></label>
                                <input type="text" id="hospital_name" name="hospital_name" class="form-control" value="{{ old('hospital_name') }}" required>
                            </div>
                            <div class="col-md-6">
                                <label for="owner_name" class="form-label">Owner Name <span class="text-danger">*</span></label>
                                <input type="text" id="owner_name" name="owner_name" class="form-control" value="{{ old('owner_name') }}" required>
                            </div>
                        </div>

                        <div class="mt-3">
                            <label for="email" class="form-label">Gmail / Email Address <span class="text-danger">*</span></label>
                            <input type="email" id="email" name="email" class="form-control" value="{{ old('email') }}" required>
                        </div>

                        <div class="row g-3 mt-1">
                            <div class="col-md-6">
                                <label for="phone" class="form-label">Phone Number <span class="text-danger">*</span></label>
                                <input type="tel" id="phone" name="phone" class="form-control" value="{{ old('phone') }}" required>
                            </div>
                            <div class="col-md-6">
                                <label for="hospital_location" class="form-label">Location <span class="text-danger">*</span></label>
                                <input type="text" id="hospital_location" name="hospital_location" class="form-control" value="{{ old('hospital_location') }}" required>
                            </div>
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
                            <button type="submit" class="btn btn-info-custom">Submit For Approval</button>
                        </div>
                    </form>

                    <p class="text-center mt-4 mb-0">
                        Already approved? <a href="{{ route('login') }}" class="fw-semibold text-info text-decoration-none">Sign in here</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
