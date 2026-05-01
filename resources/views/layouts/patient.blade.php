<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', __('Patient Dashboard'))</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('admin/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css"
      integrity="sha256-9kPW/n5nn53j4WMRYAxe9c1rCY96Oogo/MKSVdKzPmI="
      crossorigin="anonymous"
    />
    <link href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css" rel="stylesheet">

    <style>
        :root {
            --patient-primary: #0f766e;
            --patient-primary-soft: #e8f6f4;
            --patient-text: #12343b;
            --patient-border: #d9e7e5;
        }

        body {
            background:
                radial-gradient(circle at top left, rgba(15, 118, 110, 0.08), transparent 30%),
                linear-gradient(180deg, #f7fbfb 0%, #eef5f4 100%);
            color: var(--patient-text);
        }

        .app_logo {
            width: 40px;
            border-radius: 100%;
        }

        .sidebar {
            width: 250px;
            position: fixed;
            top: 64px;
            left: 0;
            height: 100%;
            background-color: rgba(255, 255, 255, 0.92);
            border-right: 1px solid var(--patient-border);
            padding-top: 1rem;
            backdrop-filter: blur(12px);
        }

        .sidebar a {
            align-items: center;
            border-radius: 14px;
            color: var(--patient-primary);
            text-decoration: none;
            display: flex;
            gap: .75rem;
            padding: .85rem 1rem;
            margin: .3rem .75rem;
            transition: all .2s ease;
        }

        .sidebar a.active {
            background: var(--patient-primary-soft);
            color: var(--patient-primary);
            font-weight: 700;
        }

        .sidebar a:hover {
            background: var(--patient-primary-soft);
            color: var(--patient-primary);
        }

        .content {
            margin-left: 250px;
            padding: 24px;
            min-height: 100vh;
            margin-top: 72px;
        }

        .patient-surface {
            background: rgba(255, 255, 255, 0.92);
            border: 1px solid rgba(217, 231, 229, 0.9);
            border-radius: 22px;
            box-shadow: 0 18px 40px rgba(18, 52, 59, 0.06);
        }

        .patient-muted {
            color: #5f7a80;
        }

        .panel-stat {
            border: 1px solid rgba(217, 231, 229, 0.85);
            border-radius: 18px;
            background: linear-gradient(180deg, #ffffff 0%, #f6fbfb 100%);
        }

        .table > :not(caption) > * > * {
            vertical-align: middle;
        }

        @media (max-width: 991px) {
            .sidebar {
                display: none;
            }

            .content {
                margin-left: 0;
                padding: 16px;
            }
        }
    </style>
    @stack('styles')
</head>
<body>

    <!-- Header -->
   @includeIf('partials.patient.header')
    <!-- Sidebar for large screen -->
    @includeIf('partials.patient.sidebar')

    <!-- Main Content -->
    <main class="content">
        @if (session('success'))
            <div class="alert alert-success shadow-sm border-0">{{ session('success') }}</div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger shadow-sm border-0">{{ session('error') }}</div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger shadow-sm border-0">
                <strong class="d-block mb-1">{{ __('Please fix the following issues:') }}</strong>
                <ul class="mb-0 ps-3">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @yield('content')
    </main>

      {{-- jquery js add --}}
    <script src="{{asset('assets/js/query.min.js')}}"></script>
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
    @stack('scripts')
</body>
</html>
