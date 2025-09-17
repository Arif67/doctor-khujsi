<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Hospital Management System')</title>
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
<body>
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
</body>
</html>