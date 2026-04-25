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
        gap: 60px;
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
        outline: none;
    }
    
    .form-group input:focus {
        border-color: #2c8c99;
        box-shadow: 0 0 0 3px rgba(44, 140, 153, 0.1);
    }
    
    .required {
        color: #e74c3c;
    }
    
    .form-options {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin: 8px 0;
    }
    
    .remember-me {
        display: flex;
        align-items: center;
        gap: 8px;
        font-size: 0.9rem;
        color: #666;
        cursor: pointer;
    }
    
    .remember-me input[type="checkbox"] {
        width: 16px;
        height: 16px;
        accent-color: #2c8c99;
    }
    
    .forgot-password {
        font-size: 0.9rem;
        color: #2c8c99;
        text-decoration: none;
        font-weight: 500;
    }
    
    .forgot-password:hover {
        text-decoration: underline;
    }
    
    .signin-btn {
        background: #2c8c99;
        color: white;
        border: none;
        padding: 16px;
        border-radius: 8px;
        font-size: 1rem;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
        font-family: 'Poppins', sans-serif;
    }
    
    .signin-btn:hover {
        background: #247a85;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(44, 140, 153, 0.3);
    }
    
    .signup-link {
        text-align: center;
        margin-top: 32px;
        font-size: 0.95rem;
        color: #666;
    }
    
    .signup-link a {
        color: #2c8c99;
        text-decoration: none;
        font-weight: 600;
    }
    
    .signup-link a:hover {
        text-decoration: underline;
    }
    
    .alert {
        padding: 12px 16px;
        border-radius: 8px;
        margin-bottom: 20px;
        font-size: 0.9rem;
    }
    
    .alert-success {
        background: #d4edda;
        color: #155724;
        border: 1px solid #c3e6cb;
    }
    
    .alert-error {
        background: #f8d7da;
        color: #721c24;
        border: 1px solid #f5c6cb;
    }
    
    @media (max-width: 768px) {
        .signin-container {
            flex-direction: column;
            gap: 40px;
            align-items: center;
        }
        
        .signin-image {
            width: 280px;
            height: 280px;
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
            margin-bottom: 30px;
        }
        
        .form-options {
            flex-direction: column;
            gap: 16px;
            align-items: flex-start;
        }
    }
    
    @media (max-width: 480px) {
        .main-wrap {
            padding: 20px 15px;
        }
        
        .signin-image {
            width: 220px;
            height: 220px;
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
            <img src="https://i.postimg.cc/yN0NFzRH/image.png" alt="signin-image">
        </div>
        
        <div class="signin-content">
            @if (session('status'))
                <div class="alert alert-success">{{ session('status') }}</div>
            @endif

            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            @if (session('error'))
                <div class="alert alert-error">{{ session('error') }}</div>
            @endif

            <h1 class="signin-title">Welcome Back</h1>
            <p class="signin-subtitle">Sign in to your account to access your healthcare dashboard and manage your appointments.</p>
            
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
                    <label for="email">Email Address <span class="required">*</span></label>
                    <input type="email" id="email" name="email" value="{{ old('email') }}" required>
                </div>
                
                <div class="form-group">
                    <label for="password">Password <span class="required">*</span></label>
                    <input type="password" id="password" name="password" required>
                </div>
                
                <div class="form-options">
                    <label class="remember-me">
                        <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}>
                        Remember me
                    </label>
                    <a href="{{ route('password.request') }}" class="forgot-password">Forgot Password?</a>
                </div>
                
                <button type="submit" class="signin-btn">Sign In</button>
            </form>
            
            <div class="signup-link">
                Don't have an account? <a href="{{ route('register') }}">Sign up here</a>
            </div>
        </div>
    </div>
</div>
@endsection
