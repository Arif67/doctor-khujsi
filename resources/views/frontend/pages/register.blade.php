@extends('layouts.app')

@section('title', 'Register - Hospital Management')

{{-- @section('styles')
<style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap');
    
    body {
        margin: 0;
        padding: 0;
        background: #fff;
        font-family: 'Poppins', sans-serif;
    }
    
    .register-wrap {
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 40px 20px;
    }
    
    .register-card {
        background: #fff;
        border: 1px solid #3BAFBF;
        border-radius: 14px;
        box-shadow: 0 10px 30px rgba(59, 175, 191, 0.1);
        padding: 44px 48px 36px 48px;
        min-width: 400px;
        max-width: 500px;
        width: 100%;
        position: relative;
        display: flex;
        flex-direction: column;
        align-items: center;
    }
    
    .close-btn {
        background: transparent;
        border: none;
        color: #222;
        font-size: 22px;
        cursor: pointer;
        position: absolute;
        top: 24px;
        right: 28px;
        transition: color 0.3s;
    }
    
    .close-btn:hover {
        color: #22B8CF;
    }
    
    .register-title {
        font-size: 22px;
        font-weight: 600;
        color: #222;
        margin-bottom: 36px;
        margin-top: 8px;
        text-align: center;
    }
    
    .register-form {
        width: 100%;
        display: flex;
        flex-direction: column;
        gap: 20px;
    }
    
    .form-row {
        display: flex;
        gap: 16px;
    }
    
    .form-group {
        flex: 1;
        display: flex;
        flex-direction: column;
    }
    
    .form-group label {
        font-size: 14px;
        font-weight: 500;
        color: #333;
        margin-bottom: 8px;
    }
    
    .form-group input,
    .form-group select {
        padding: 12px 16px;
        border: 1px solid #ddd;
        border-radius: 6px;
        font-size: 14px;
        font-family: 'Poppins', sans-serif;
        transition: border-color 0.3s ease;
        background: #fff;
    }
    
    .form-group input:focus,
    .form-group select:focus {
        outline: none;
        border-color: #22B8CF;
        box-shadow: 0 0 0 2px rgba(34, 184, 207, 0.1);
    }
    
    .terms-group {
        display: flex;
        align-items: flex-start;
        gap: 10px;
        margin: 10px 0;
    }
    
    .terms-group input[type="checkbox"] {
        width: 16px;
        height: 16px;
        accent-color: #22B8CF;
        margin-top: 2px;
        flex-shrink: 0;
    }
    
    .terms-text {
        font-size: 13px;
        color: #666;
        line-height: 1.4;
    }
    
    .terms-text a {
        color: #22B8CF;
        text-decoration: none;
        transition: color 0.3s;
    }
    
    .terms-text a:hover {
        color: #1a9bb0;
        text-decoration: underline;
    }
    
    .register-btn {
        background: #22B8CF;
        color: white;
        padding: 14px 32px;
        border: none;
        border-radius: 6px;
        font-size: 16px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
        margin-top: 10px;
    }
    
    .register-btn:hover {
        background: #1a9bb0;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(34, 184, 207, 0.3);
    }
    
    .signin-link {
        text-align: center;
        margin-top: 24px;
        font-size: 14px;
        color: #666;
    }
    
    .signin-link a {
        color: #22B8CF;
        text-decoration: none;
        font-weight: 500;
        transition: color 0.3s;
    }
    
    .signin-link a:hover {
        color: #1a9bb0;
        text-decoration: underline;
    }
    
    .required {
        color: #e74c3c;
    }
    
    /* Alert Messages */
    .alert {
        padding: 12px 16px;
        border-radius: 6px;
        margin-bottom: 20px;
        font-size: 14px;
        width: 100%;
    }
    
    .alert-success {
        background-color: #d4edda;
        color: #155724;
        border: 1px solid #c3e6cb;
    }
    
    .alert-error {
        background-color: #f8d7da;
        color: #721c24;
        border: 1px solid #f5c6cb;
    }
    
    /* Responsive Design */
    @media (max-width: 768px) {
        .register-card {
            min-width: auto;
            max-width: none;
            margin: 0 20px;
            padding: 32px 24px;
        }
        
        .form-row {
            flex-direction: column;
            gap: 12px;
        }
        
        .register-title {
            font-size: 20px;
            margin-bottom: 24px;
        }
    }
    
    @media (max-width: 480px) {
        .register-wrap {
            padding: 20px 15px;
        }
        
        .register-card {
            padding: 24px 20px;
        }
        
        .register-title {
            font-size: 18px;
        }
    }
</style>
@endsection

@section('content')
<div class="register-wrap">
    <div class="register-card">
        <button class="close-btn" onclick="window.history.back()">
            <i class="fas fa-times"></i>
        </button>
        
        <h1 class="register-title">Create Your Account</h1>
        
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        
        @if($errors->any())
            <div class="alert alert-error">
                @foreach($errors->all() as $error)
                    <div>{{ $error }}</div>
                @endforeach
            </div>
        @endif
        
        <form class="register-form" action="{{ route('register') }}" method="POST">
            @csrf
            
            <div class="form-row">
                <div class="form-group">
                    <label for="first_name">First Name <span class="required">*</span></label>
                    <input type="text" id="first_name" name="first_name" value="{{ old('first_name') }}" required>
                </div>
                <div class="form-group">
                    <label for="last_name">Last Name <span class="required">*</span></label>
                    <input type="text" id="last_name" name="last_name" value="{{ old('last_name') }}" required>
                </div>
            </div>
            
            <div class="form-group">
                <label for="email">Email Address <span class="required">*</span></label>
                <input type="email" id="email" name="email" value="{{ old('email') }}" required>
            </div>
            
            <div class="form-row">
                <div class="form-group">
                    <label for="phone">Phone Number <span class="required">*</span></label>
                    <input type="tel" id="phone" name="phone" value="{{ old('phone') }}" required>
                </div>
                <div class="form-group">
                    <label for="date_of_birth">Date of Birth</label>
                    <input type="date" id="date_of_birth" name="date_of_birth" value="{{ old('date_of_birth') }}">
                </div>
            </div>
            
            <div class="form-row">
                <div class="form-group">
                    <label for="gender">Gender</label>
                    <select id="gender" name="gender">
                        <option value="">Select Gender</option>
                        <option value="male" {{ old('gender') == 'male' ? 'selected' : '' }}>Male</option>
                        <option value="female" {{ old('gender') == 'female' ? 'selected' : '' }}>Female</option>
                        <option value="other" {{ old('gender') == 'other' ? 'selected' : '' }}>Other</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="blood_group">Blood Group</label>
                    <select id="blood_group" name="blood_group">
                        <option value="">Select Blood Group</option>
                        <option value="A+" {{ old('blood_group') == 'A+' ? 'selected' : '' }}>A+</option>
                        <option value="A-" {{ old('blood_group') == 'A-' ? 'selected' : '' }}>A-</option>
                        <option value="B+" {{ old('blood_group') == 'B+' ? 'selected' : '' }}>B+</option>
                        <option value="B-" {{ old('blood_group') == 'B-' ? 'selected' : '' }}>B-</option>
                        <option value="AB+" {{ old('blood_group') == 'AB+' ? 'selected' : '' }}>AB+</option>
                        <option value="AB-" {{ old('blood_group') == 'AB-' ? 'selected' : '' }}>AB-</option>
                        <option value="O+" {{ old('blood_group') == 'O+' ? 'selected' : '' }}>O+</option>
                        <option value="O-" {{ old('blood_group') == 'O-' ? 'selected' : '' }}>O-</option>
                    </select>
                </div>
            </div>
            
            <div class="form-group">
                <label for="address">Address</label>
                <input type="text" id="address" name="address" value="{{ old('address') }}" placeholder="Enter your full address">
            </div>
            
            <div class="form-row">
                <div class="form-group">
                    <label for="password">Password <span class="required">*</span></label>
                    <input type="password" id="password" name="password" required>
                </div>
                <div class="form-group">
                    <label for="password_confirmation">Confirm Password <span class="required">*</span></label>
                    <input type="password" id="password_confirmation" name="password_confirmation" required>
                </div>
            </div>
            
            <div class="terms-group">
                <input type="checkbox" id="terms" name="terms" required {{ old('terms') ? 'checked' : '' }}>
                <label for="terms" class="terms-text">
                    I agree to the <a href="#" target="_blank">Terms of Service</a> and <a href="#" target="_blank">Privacy Policy</a>
                </label>
            </div>
            
            <button type="submit" class="register-btn">Create Account</button>
        </form>
        
        <div class="signin-link">
            Already have an account? <a href="{{ route('login') }}">Sign in here</a>
        </div>
    </div>
</div>
@endsection --}}

@section('content')
<div class="container d-flex justify-content-center align-items-center min-vh-100">
    <div class="card shadow-lg border-0 rounded-4 p-4 p-md-5" style="max-width: 550px; width: 100%;">
        {{-- Close Button --}}
        <button class="btn-close position-absolute top-0 end-0 m-3" onclick="window.history.back()"></button>

        {{-- Title --}}
        <h3 class="text-center mb-4 fw-semibold">{{ __('Create Your Account') }}</h3>

        {{-- Success Message --}}
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        {{-- Error Messages --}}
        @if($errors->any())
            <div class="alert alert-danger">
                @foreach($errors->all() as $error)
                    <div>{{ $error }}</div>
                @endforeach
            </div>
        @endif

        {{-- Register Form --}}
        <form action="{{ route('register') }}" method="POST">
            @csrf

            <div class="row g-3">
                {{-- First Name --}}
                <div class="col-md-6">
                    <label for="first_name" class="form-label">{{ __('First Name') }} <span class="text-danger">*</span></label>
                    <input type="text" id="first_name" name="first_name" 
                           class="form-control" value="{{ old('first_name') }}" required>
                </div>
                {{-- Last Name --}}
                <div class="col-md-6">
                    <label for="last_name" class="form-label">{{ __('Last Name') }} <span class="text-danger">*</span></label>
                    <input type="text" id="last_name" name="last_name" 
                           class="form-control" value="{{ old('last_name') }}" required>
                </div>
            </div>

            {{-- Email --}}
            <div class="mt-3">
                <label for="email" class="form-label">{{ __('Email Address') }} <span class="text-danger">*</span></label>
                <input type="email" id="email" name="email" 
                       class="form-control" value="{{ old('email') }}" required>
            </div>

            <div class="row g-3 mt-1">
                {{-- Phone --}}
                <div class="col-md-6">
                    <label for="phone" class="form-label">{{ __('Phone Number') }} <span class="text-danger">*</span></label>
                    <input type="tel" id="phone" name="phone" 
                           class="form-control" value="{{ old('phone') }}" required>
                </div>
                {{-- DOB --}}
                <div class="col-md-6">
                    <label for="date_of_birth" class="form-label">{{ __('Date of Birth') }}</label>
                    <input type="date" id="date_of_birth" name="date_of_birth" 
                           class="form-control" value="{{ old('date_of_birth') }}">
                </div>
            </div>

            <div class="row g-3 mt-1">
                {{-- Gender --}}
                <div class="col-md-6">
                    <label for="gender" class="form-label">{{ __('Gender') }}</label>
                    <select id="gender" name="gender" class="form-select">
                        <option value="">{{ __('Select Gender') }}</option>
                        <option value="male" {{ old('gender') == 'male' ? 'selected' : '' }}>{{ __('Male') }}</option>
                        <option value="female" {{ old('gender') == 'female' ? 'selected' : '' }}>{{ __('Female') }}</option>
                        <option value="other" {{ old('gender') == 'other' ? 'selected' : '' }}>{{ __('Other') }}</option>
                    </select>
                </div>
                {{-- Blood Group --}}
                <div class="col-md-6">
                    <label for="blood_group" class="form-label">{{ __('Blood Group') }}</label>
                    <select id="blood_group" name="blood_group" class="form-select">
                        <option value="">{{ __('Select Blood Group') }}</option>
                        @foreach(['A+','A-','B+','B-','AB+','AB-','O+','O-'] as $bg)
                            <option value="{{ $bg }}" {{ old('blood_group') == $bg ? 'selected' : '' }}>{{ $bg }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            {{-- Address --}}
            <div class="mt-3">
                <label for="address" class="form-label">{{ __('Address') }}</label>
                <input type="text" id="address" name="address" 
                       class="form-control" value="{{ old('address') }}" placeholder="{{ __('Enter your full address') }}">
            </div>

            <div class="row g-3 mt-1">
                {{-- Password --}}
                <div class="col-md-6">
                    <label for="password" class="form-label">{{ __('Password') }} <span class="text-danger">*</span></label>
                    <input type="password" id="password" name="password" class="form-control" required>
                </div>
                {{-- Confirm Password --}}
                <div class="col-md-6">
                    <label for="password_confirmation" class="form-label">{{ __('Confirm Password') }} <span class="text-danger">*</span></label>
                    <input type="password" id="password_confirmation" name="password_confirmation" class="form-control" required>
                </div>
            </div>

            {{-- Terms --}}
            <div class="form-check mt-3">
                <input type="checkbox" id="terms" name="terms" class="form-check-input" required {{ old('terms') ? 'checked' : '' }}>
                <label for="terms" class="form-check-label">
                    {{ __('I agree to the') }} <a href="#" class="text-decoration-none">{{ __('Terms of Service') }}</a> {{ __('and') }} 
                    <a href="#" class="text-decoration-none">{{ __('Privacy Policy') }}</a>
                </label>
            </div>

            {{-- Submit --}}
            <div class="d-grid mt-4">
                <button type="submit" class="btn btn-info text-white fw-semibold">{{ __('Create Account') }}</button>
            </div>
        </form>

        {{-- Sign in link --}}
        <p class="text-center mt-4 mb-0">
            {{ __('Already have an account?') }} 
            <a href="{{ route('login') }}" class="fw-semibold text-info text-decoration-none">{{ __('Sign in here') }}</a>
        </p>
    </div>
</div>
@endsection
