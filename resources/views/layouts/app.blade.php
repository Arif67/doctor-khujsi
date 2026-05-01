<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="@yield('meta_description', 'Doctor Finder helps patients browse trusted doctors, hospitals, specialties, and booking guidance.')">
    <meta name="keywords" content="@yield('meta_keywords', 'doctor finder, hospitals, doctors, specialties, booking, health blog')">
    <meta property="og:title" content="@yield('og_title', View::yieldContent('title', 'Doctor Finder'))">
    <meta property="og:description" content="@yield('og_description', View::yieldContent('meta_description', 'Doctor Finder helps patients browse trusted doctors, hospitals, specialties, and booking guidance.'))">
    <meta property="og:type" content="@yield('og_type', 'website')">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:image" content="@yield('og_image', asset('assets/img/register.jpg'))">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="@yield('twitter_title', View::yieldContent('og_title', View::yieldContent('title', 'Doctor Finder')))">
    <meta name="twitter:description" content="@yield('twitter_description', View::yieldContent('og_description', View::yieldContent('meta_description', 'Doctor Finder helps patients browse trusted doctors, hospitals, specialties, and booking guidance.')))">
    <meta name="twitter:image" content="@yield('twitter_image', View::yieldContent('og_image', asset('assets/img/register.jpg')))">

    <title>@yield('title', 'Doctor Finder')</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick-theme.css"/>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=ABeeZee:ital@0;1&family=Aref+Ruqaa+Ink:wght@400;700&family=Be+Vietnam+Pro:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Bebas+Neue&family=Belgrano&family=Biryani:wght@200;300;400;600;700;800;900&family=Carattere&family=Epilogue:ital,wght@0,100..900;1,100..900&family=Figtree:ital,wght@0,300..900;1,300..900&family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Jura:wght@300..700&family=Krub:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;1,200;1,300;1,400;1,500;1,600;1,700&family=Manrope:wght@200..800&family=Montserrat+Alternates:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Montserrat:ital,wght@0,100..900;1,100..900&family=Nunito+Sans:ital,opsz,wght@0,6..12,200..1000;1,6..12,200..1000&family=Open+Sans:ital,wght@0,300..800;1,300..800&family=Outfit:wght@100..900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Roboto+Condensed:ital,wght@0,100..900;1,100..900&family=Roboto:ital,wght@0,100..900;1,100..900&family=Rubik:ital,wght@0,300..900;1,300..900&family=Sora:wght@100..800&family=Zen+Kaku+Gothic+Antique:wght@400;500;700;900&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet">

    {{-- bootstrap cdn add --}}
    <link rel="stylesheet" href="{{asset('assets/css/bootstrap.min.css')}}">   
    <link rel="stylesheet" href="{{asset('assets/css/app_style.css')}}">

    <!-- Custom Styles -->
   @stack('styles')
    <style>
        #toast-container>.toast-error{
            background-color: red;
            opacity: 1;
        }
        #toast-container>.toast-success{
            background-color: green;
            opacity: 1;
        }
    </style>
</head>
<body class="app-shell">
    @includeIf('partials.app.header')
    @yield('content')

    @includeIf('partials.app.footer')
    @yield('scripts')
    <audio id="successSound">
        <source src="{{ asset('assets/mp3/ton.m4a') }}" type="audio/mpeg">
    </audio>

    {{-- jquery js add --}}
    <script src="{{asset('assets/js/query.min.js')}}"></script>
    {{-- slick js add --}}
    <script src="{{asset('assets/js/slick.min.js')}}"></script>
    {{-- bootstrap js add --}}
    <script src="{{asset('assets/js/bootstrap.min.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    @stack('scripts')
    <script>
        toastr.options = {
            "closeButton": true,
            "progressBar": true,
            "positionClass": "toast-top-right",
            "timeOut": 3000,   
        };

         // Audio helper
        function playSound() {
            const audio = document.getElementById("successSound");
            if(audio){
                audio.currentTime = 0;
                audio.play();
            }
        }

        @if(session('success'))
            toastr.success("{{ session('success') }}");
            playSound();
        @endif

        @if(session('error'))
            toastr.error("{{ session('error') }}");
            playSound();
        @endif

    </script>
    <style>
        :root {
            --brand-ink: #153a3f;
            --brand-muted: #5f7b80;
            --brand-primary: #127c8a;
            --brand-primary-dark: #0d5b65;
            --brand-accent: #f4a261;
            --brand-surface: #f5fbfb;
            --brand-line: #d7e7e8;
            --brand-card: #ffffff;
            --brand-shadow: 0 24px 60px rgba(15, 55, 60, 0.08);
        }

        html {
            scroll-behavior: smooth;
        }

        body.app-shell {
            margin: 0;
            color: var(--brand-ink);
            background:
                radial-gradient(circle at top left, rgba(18, 124, 138, 0.08), transparent 30%),
                linear-gradient(180deg, #f8fcfc 0%, #ffffff 34%);
            font-family: "Manrope", sans-serif;
        }

        .section-eyebrow {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 9px 16px;
            border-radius: 999px;
            background: rgba(18, 124, 138, 0.08);
            color: var(--brand-primary-dark);
            font-size: 0.85rem;
            font-weight: 700;
            letter-spacing: 0.04em;
            text-transform: uppercase;
        }

        .section-title,
        .heading_title {
            font-family: "Sora", sans-serif;
            font-size: clamp(2rem, 4vw, 3.5rem);
            line-height: 1.05;
            letter-spacing: -0.04em;
            color: var(--brand-ink);
            margin: 0;
            font-weight: 700;
        }

        .surface-card {
            background: var(--brand-card);
            border: 1px solid rgba(21, 58, 63, 0.08);
            box-shadow: var(--brand-shadow);
            border-radius: 28px;
        }

        .btn-brand-primary,
        .btn-brand-secondary {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            border-radius: 16px;
            padding: 14px 22px;
            font-weight: 700;
            text-decoration: none;
            transition: transform 0.2s ease, box-shadow 0.2s ease, background 0.2s ease, color 0.2s ease;
        }

        .btn-brand-primary {
            background: var(--brand-primary);
            color: #fff;
            box-shadow: 0 16px 30px rgba(18, 124, 138, 0.22);
        }

        .btn-brand-primary:hover {
            color: #fff;
            background: var(--brand-primary-dark);
            transform: translateY(-2px);
        }

        .btn-brand-secondary {
            background: #fff;
            color: var(--brand-primary-dark);
            border: 1px solid rgba(18, 124, 138, 0.18);
        }

        .btn-brand-secondary:hover {
            color: var(--brand-primary-dark);
            transform: translateY(-2px);
            box-shadow: 0 14px 30px rgba(15, 55, 60, 0.1);
        }

        .muted-copy {
            color: var(--brand-muted);
        }
    </style>
</body>
</html>
