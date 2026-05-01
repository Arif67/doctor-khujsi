@extends('frontend.layout.masterlayout')

@section('title', 'Sign In - Hospital Management')

@section('styles')
<style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap');
    
    body {
        margin: 0;
        padding: 0;
        background: #fff;
        font-family: 'Poppins', sans-serif;
    }
    
    .main-wrap {
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 40px 20px;
    }
    
    .signin-container {
        display: flex;
        align-items: flex-start;
        background: transparent;
        gap: 0;
        max-width: 1000px;
        width: 100%;
    }
    
    .signin-image {
        width: 370px;
        height: 370px;
        border-radius: 20px;
        overflow: hidden;
        background: #f7f7f7;
        box-shadow: none;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }
    
    .signin-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        border-radius: 20px;
    }
    
    .signin-content {
        background: #fff;
        border-radius: 0;
        box-shadow: none;
        padding: 0;
        min-width: 400px;
        flex: 1;
    }
    
    .signin-title {
        font-size: 2.5rem;
        font-weight: 700;
        color: #333;
        margin-bottom: 8px;
        line-height: 1.2;
    }
    
    .signin-subtitle {
        font-size: 1rem;
        color: #666;
        margin-bottom: 40px;
        line-height: 1.5;
    }
    
    .signin-form {
        display: flex;
        flex-direction: column;
        gap: 24px;
    }
    
    .form-group {
        display: flex;
        flex-direction: column;
    }
    
    .form-group label {
        font-size: 0.9rem;
        font-weight: 500;
        color: #333;
        margin-bottom: 8px;
    }
    
    .form-group input {
        padding: 14px 16px;
        border: 2px solid #e5e5e5;
        border-radius: 8px;
        font-size: 0.95rem;
        font-family: 'Poppins', sans-serif;
        transition: border-color 0.3s ease;
        background: #fff;
    }
    
    .form-group input:focus {
        outline: none;
        border-color: #22B8CF;
        box-shadow: 0 0 0 3px rgba(34, 184, 207, 0.1);
    }
    
    .form-options {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin: 10px 0;
    }
    
    .remember-me {
        display: flex;
        align-items: center;
        gap: 8px;
        font-size: 0.9rem;
        color: #666;
    }
    
    .remember-me input[type="checkbox"] {
        width: 16px;
        height: 16px;
        accent-color: #22B8CF;
    }
    
    .forgot-password {
        color: #22B8CF;
        font-size: 0.9rem;
        text-decoration: none;
        transition: color 0.3s;
    }
    
    .forgot-password:hover {
        color: #1a9bb0;
        text-decoration: underline;
    }
    
    .signin-btn {
        background: #22B8CF;
        color: white;
        padding: 16px 32px;
        border: none;
        border-radius: 8px;
        font-size: 1rem;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
        margin-top: 10px;
    }
    
    .signin-btn:hover {
        background: #1a9bb0;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(34, 184, 207, 0.3);
    }
    
    .signup-link {
        text-align: center;
        margin-top: 30px;
        font-size: 0.95rem;
        color: #666;
    }
    
    .signup-link a {
        color: #22B8CF;
        text-decoration: none;
        font-weight: 500;
        transition: color 0.3s;
    }
    
    .signup-link a:hover {
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
        font-size: 0.9rem;
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
        .signin-container {
            flex-direction: column;
            gap: 40px;
            align-items: center;
        }
        
        .signin-image {
            width: 300px;
            height: 300px;
        }
        
        .signin-content {
            min-width: auto;
            width: 100%;
            max-width: 400px;
        }
        
        .signin-title {
            font-size: 2rem;
            text-align: center;
        }
        
        .signin-subtitle {
            text-align: center;
        }
        
        .form-options {
            flex-direction: column;
            gap: 15px;
            align-items: flex-start;
        }
    }
    
    @media (max-width: 480px) {
        .main-wrap {
            padding: 20px 15px;
        }
        
        .signin-image {
            width: 250px;
            height: 250px;
        }
        
        .signin-title {
            font-size: 1.8rem;
        }
    }
</style>
@endsection

@section('content')
<div class="main-wrap">
    <div class="signin-container">
        <div class="signin-image">
            <img src="{{ asset('assets/img/register.jpg') }}" alt="{{ __('Hospital reception') }}">
        </div>
        
        <div class="signin-content">
            <h1 class="signin-title">{{ __('Welcome Back') }}</h1>
            <p class="signin-subtitle">{{ __('Sign in to your account to access your healthcare dashboard and manage your appointments.') }}</p>
            
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
            
            <form class="signin-form" action="{{ route('login') }}" method="POST">
                @csrf
                
                <div class="form-group">
                    <label for="email">{{ __('Email Address') }} <span class="required">*</span></label>
                    <input type="email" id="email" name="email" value="{{ old('email') }}" required>
                </div>
                
                <div class="form-group">
                    <label for="password">{{ __('Password') }} <span class="required">*</span></label>
                    <input type="password" id="password" name="password" required>
                </div>
                
                <div class="form-options">
                    <label class="remember-me">
                        <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}>
                        {{ __('Remember me') }}
                    </label>
                    <a href="{{ route('password.request') }}" class="forgot-password">{{ __('Forgot Password?') }}</a>
                </div>
                
                <button type="submit" class="signin-btn">{{ __('Sign In') }}</button>
            </form>
            
            <div class="signup-link">
                {{ __('Don\'t have an account?') }} <a href="{{ route('register') }}">{{ __('Sign up here') }}</a>
            </div>
        </div>
    </div>
</div>
@endsection
