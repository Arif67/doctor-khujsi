@extends('layouts.app')

@section('title', __('About Us - Hospital Management'))

@section('content')
<section class="services-section">
    <div class="container px-4 px-md-4">
        <div class="row row-gap-5 align-items-center">
            <div class="col-md-6">
                <div class="services-img">
                    <img class="" src="https://i.postimg.cc/YSb49tfX/image.png" alt="{{ __('Exercise Services') }}">
                </div>
            </div>
            <div class="col-md-6">
                 <div class="services-content">
                    <span class="services-pill">{{ __('Our Services') }}</span>
                    <div class="heading_title mb-4">{{ __('We Provide The Best') }} <br> {{ __('Services') }}</div>
                    <div class="services-desc">
                        {{ __('World-class rehabilitation solutions and individualized recovery plans, from acute care to ongoing outpatient treatment and beyond.') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="about-section">
    <div class="container">
        <div class="row row-gap-5 align-items-center">
            <div class="col-md-6">
                <div class="about-conent">
                    <h1 class="heading_title">{{ __('How We Get You Better') }}</h1>
                    <p class="description">
                        {{ __('We focus on practical recovery support, coordinated care planning, and patient-first guidance so every treatment journey feels clear, structured, and easier to follow.') }}
                    </p>
                </div>
            </div>
            <div class="col-md-6">
                <div class="about-image">
                    <img src="https://i.postimg.cc/44FzPQc8/image.png" alt="{{ __('About Us Image') }}">
                </div>
            </div>
        </div>
        
        
    </div>
</section>

@includeIf('components.app.doctors')
@endsection
