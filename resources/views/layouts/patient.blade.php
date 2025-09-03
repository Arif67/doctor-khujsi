<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title','Patient Dashboard')</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('admin/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css"
      integrity="sha256-9kPW/n5nn53j4WMRYAxe9c1rCY96Oogo/MKSVdKzPmI="
      crossorigin="anonymous"
    />
    <style>
        body {
            background-color: #f8f9fa; /* gray background */
        }
        .app_logo{
            width: 40px;
            border-radius: 100%;
        }
        .sidebar {
            width: 250px;
            position: fixed;
            top: 56px; /* header height */
            left: 0;
            height: 100%;
            background-color: #ffffff; /* white sidebar */
            border-right: 1px solid #dee2e6;
            padding-top: 1rem;
        }
        .sidebar a {
            color: #00796b;
            text-decoration: none;
            display: block;
            padding: .75rem 1rem;
            margin: 5px 0px;
        }
        .sidebar a.active{
            background: #eaf6f3;
            color: #00796b;
            font-weight: bold;
        }
        .sidebar a:hover {
            background: #eaf6f3;
            color: #00796b;
            font-weight: bold;
        }
        .content {
            margin-left: 250px;
            padding: 20px;
            background-color: #f1f3f5; /* gray main content */
            min-height: 100vh;
            margin-top: 70px;
        }
        @media (max-width: 991px) {
            .sidebar {
                display: none;
            }
            .content {
                margin-left: 0;
            }
        }
    </style>
</head>
<body>

    <!-- Header -->
   @includeIf('partials.patient.header')
    <!-- Sidebar for large screen -->
    @includeIf('partials.patient.sidebar')

    <!-- Main Content -->
    <main class="content">
        @yield('content')
    </main>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
