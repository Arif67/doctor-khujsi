@extends('frontend.layout.masterlayout')

@section('title', 'Chiropractic Care')

@section('styles')
<style>
    .main-nav .container {
        display: flex;
        align-items: center;
        justify-content: space-between;
    }
    .nav-toggle {
        display: none;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        width: 40px;
        height: 40px;
        background: none;
        border: none;
        cursor: pointer;
        margin-left: 10px;
    }
    .nav-toggle .bar {
        width: 28px;
        height: 3px;
        background: #222;
        margin: 4px 0;
        border-radius: 2px;
        transition: 0.3s;
    }
    @media (max-width: 900px) {
        .main-nav .container {
            flex-direction: row;
            align-items: center;
            justify-content: space-between;
            gap: 0;
            position: relative;
            width: 100%;
        }
        .main-nav .container > .logo,
        .main-nav .container > .nav-toggle,
        .main-nav .container > .icon-container,
        .main-nav .container > .call-button {
            margin: 0 4px;
        }
        .nav-toggle {
            display: flex;
        }
        .nav-links {
            display: none;
            flex-direction: column;
            width: 100%;
            background: #fff;
            position: absolute;
            top: 100%;
            left: 0;
            z-index: 1000;
            box-shadow: 0 2px 8px rgba(0,0,0,0.05);
            padding: 8px 0;
        }
        .nav-links.active {
            display: flex;
        }
        .nav-links li {
            margin: 10px 0;
            text-align: left;
            width: 100%;
            padding-left: 24px;
        }
        .icon-container,
        .call-button {
            display: flex;
            align-items: center;
        }
        .call-button {
            font-size: 1em;
        }
    }
</style>
<style>
    body {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: 100vh;
        background-color: #e0f2f7; 
    }

    .container {
        display: flex;
        align-items: center;
        justify-content: space-around;
        width: 90%; 
        max-width: 1200px; 
        padding: 40px 20px;
    }

    .content-left {
        flex: 1;
        max-width: 500px;
        text-align: left;
        padding-right: 40px; 
    }

    .heading-blue {
        color: #2c8c99; 
        font-size: 3.5em; 
        margin-bottom: 0.1em;
        font-weight: bold;
        letter-spacing: 0.05em;
    }

    .heading-dark {
        color: #333; 
        font-size: 3em; 
        margin-top: 0;
        margin-bottom: 0.5em;
        font-weight: bold;
        letter-spacing: 0.03em;
    }

    .description {
        color: #666; 
        font-size: 1.2em; 
        line-height: 1.6;
        margin-bottom: 2em;
        max-width: 90%;
    }

    .buttons {
        display: flex;
        gap: 20px; 
        align-items: center;
    }

    .btn-primary {
        background-color: #2c8c99; 
        color: white;
        padding: 15px 30px;
        border: none;
        border-radius: 8px;
        font-size: 1.1em;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
        text-decoration: none;
        display: inline-block;
    }

    .btn-primary:hover {
        background-color: #247a85; 
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(44, 140, 153, 0.3);
    }

    .btn-secondary {
        background: transparent;
        color: #2c8c99; 
        border: 2px solid #2c8c99;
        padding: 13px 28px;
        border-radius: 8px;
        font-size: 1.1em;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
        text-decoration: none;
        display: inline-block;
    }

    .btn-secondary:hover {
        background-color: #2c8c99;
        color: white;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(44, 140, 153, 0.2);
    }

    .content-right {
        flex: 1;
        display: flex;
        justify-content: center;
        align-items: center;
        padding-left: 40px; 
    }

    .image-placeholder {
        width: 450px; 
        height: 450px; 
        background: linear-gradient(135deg, #ffffff 0%, #f0f8ff 100%);
        border-radius: 20px;
        display: flex;
        justify-content: center;
        align-items: center;
        box-shadow: 0 10px 30px rgba(44, 140, 153, 0.15);
        border: 3px solid #ffffff;
        position: relative;
        overflow: hidden;
    }

    .image-placeholder::before {
        content: '';
        position: absolute;
        top: -50%;
        left: -50%;
        width: 200%;
        height: 200%;
        background: radial-gradient(circle, rgba(44, 140, 153, 0.1) 0%, transparent 70%);
        animation: rotate 20s linear infinite;
    }

    @keyframes rotate {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }

    .image-text {
        color: #2c8c99;
        font-size: 1.3em;
        font-weight: 600;
        z-index: 1;
        position: relative;
        text-align: center;
        padding: 20px;
    }

    @media (max-width: 768px) {
        .container {
            flex-direction: column;
            text-align: center;
            padding: 20px 10px;
        }

        .content-left, .content-right {
            padding: 0;
            margin-bottom: 30px;
        }

        .heading-blue {
            font-size: 2.5em;
        }

        .heading-dark {
            font-size: 2.2em;
        }

        .description {
            font-size: 1.1em;
            max-width: 100%;
        }

        .buttons {
            flex-direction: column;
            gap: 15px;
        }

        .image-placeholder {
            width: 300px;
            height: 300px;
        }
    }

    @media (max-width: 480px) {
        .heading-blue {
            font-size: 2em;
        }

        .heading-dark {
            font-size: 1.8em;
        }

        .image-placeholder {
            width: 250px;
            height: 250px;
        }

        .btn-primary, .btn-secondary {
            width: 100%;
            text-align: center;
        }
    }
    @media (max-width: 900px) {
        .container {
            flex-direction: column;
            align-items: center;
            padding: 18px 2vw;
        }
        .content-left, .content-right {
            max-width: 95vw;
            padding: 0;
            text-align: center;
        }
        .heading-blue {
            font-size: 2.1em;
        }
        .heading-dark {
            font-size: 1.8em;
        }
        .buttons {
            flex-direction: column;
            gap: 14px;
        }
    }
    @media (max-width: 600px) {
        .container {
            padding: 6px 1vw;
        }
        .heading-blue {
            font-size: 1.3em;
        }
        .heading-dark {
            font-size: 1.1em;
        }
        .description {
            font-size: 1em;
        }
        .content-right img {
            width: 98vw;
            max-width: 200px;
        }
    }
</style>
@endsection

@section('content')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const navToggle = document.querySelector('.nav-toggle');
    const navLinks = document.querySelector('.nav-links');
    if(navToggle && navLinks) {
        navToggle.addEventListener('click', function() {
            navLinks.classList.toggle('active');
        });
    }
});
</script>
<div class="container">
    <div class="content-left">
        <h1 class="heading-blue">Chiropractic</h1>
        <h2 class="heading-dark">Care</h2>
        <p class="description">
            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation.
        </p>
        <div class="buttons">
            <a href="{{ route('booking') }}" class="btn-primary">Book Appointment</a>
            <a href="{{ route('about') }}" class="btn-secondary">Learn More</a>
        </div>
    </div>
    <div class="content-right">
        <div class="image-placeholder">
            <div class="image-text">
                Professional<br>Healthcare<br>Services
            </div>
        </div>
    </div>
</div>
@endsection