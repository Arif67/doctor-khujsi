<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Hospital Management System')</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick-theme.css"/>

    {{-- bootstrap cdn add --}}
    <link rel="stylesheet" href="{{asset('assets/css/bootstrap.min.css')}}">   
    <link rel="stylesheet" href="{{asset('assets/css/app_style.css')}}">
    <!-- Custom Styles -->
   @stack('styles')
    
</head>
<body>
    @includeIf('partials.app.header')
    @yield('content')

    @includeIf('partials.app.footer')
    @yield('scripts')


    {{-- jquery js add --}}
    <script src="{{asset('assets/js/query.min.js')}}"></script>
    {{-- slick js add --}}
    <script src="{{asset('assets/js/slick.min.js')}}"></script>
    {{-- bootstrap js add --}}
    <script src="{{asset('assets/js/bootstrap.min.js')}}"></script>
    @stack('scripts')
</body>
</html>