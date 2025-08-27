<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link href="{{ asset('admin/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.datatables.net/2.3.2/css/dataTables.tailwindcss.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.3.2/css/dataTables.tailwindcss.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.20/summernote-lite.min.css" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('styles')
</head>
<body class="bg-gray-100 font-sans">
   
    <div x-data="{ sidebarOpen: false, sidebarCollapsed: false }" class="flex h-screen bg-white">
        <!-- 1. Sidebar -->
        @include('partials.admin.sidebar')

        <div class="flex-1 flex flex-col overflow-hidden">
            <!-- 2. Header -->
            @include('partials.admin.header')

            <!-- 3. Main Content -->
           
            <main class="flex-1 overflow-x-hidden overflow-y-auto bg-slate-100 p-6">
                <div class="container mx-auto">
                     @yield('content')
                </div>
            </main>
        </div>
    </div>

    
    @includeIf('partials.modal')

    @includeIf('partials.toast')

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script>
    <script src="https://cdn.ckeditor.com/ckeditor5/41.0.0/classic/ckeditor.js"></script>
    <script src="https://cdn.datatables.net/2.3.2/js/dataTables.js"></script>

    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>

    <script src="https://cdn.datatables.net/2.3.2/js/dataTables.tailwindcss.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.20/summernote-lite.min.js"></script>

    <script>
        function openDeleteModal(route) {
            let modal = document.querySelector(".deleteModal");
            modal.__x.$data.deleteRoute = route;
            modal.__x.$data.open = true;
        }
    </script>


    @stack('scripts')
   
</body>
</html>
