<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sweets Inventory Dashboard</title>

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Pacifico&family=Poppins:wght@400;600&display=swap"
        rel="stylesheet">
    <script>
        (function() {
                try {
                   
                    var isSidebarOpen = localStorage.getItem('isSidebarOpen');
                    if (isSidebarOpen === null) {
                      
                        isSidebarOpen = 'true';
                    }
                    if (isSidebarOpen === 'true') {
                        document.documentElement.classList.add('sidebar-open');
                    } else {
                        document.documentElement.classList.add('sidebar-closed');
                    }
                } catch (e) {
                    document.documentElement.classList.add('sidebar-open');
                }
            })();
    </script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @livewireStyles


</head>

<body class="bg-sweetPink font-body flex h-screen">
    <!-- Sidebar -->
    <aside id="sidebar"
        class="w-72 bg-white shadow-md min-h-screen hidden md:block flex-shrink-0 transition-width duration-300 overflow-y-auto">
        <div class="p-6">
            <!-- Logo -->
            @include('includes.logo')

            <!-- Navigation -->
            @if (Auth::user()->role === 'admin')
              @include('components.admin.sidebar')
            @elseif(Auth::user()->role === 'manager')
                @include('components.manager.sidebar')
            @elseif(Auth::user()->role === 'employee')
                @include('components.employee.sidebar')
            @endif
        </div>
    </aside>

    <!-- Main Content Wrapper -->
    <div id="mainWrapper" class="flex-1 flex flex-col transition-margin duration-300 ml-0 mr-0">
        <!-- Main Content -->
        <main id="mainContent" class="flex-1 bg-sweetYellow p-4 md:p-6 overflow-y-auto">
            <!-- Header -->
            @include('includes.header')

            <!-- Dynamic Contents -->
            <div class="py-6"> @yield('contents')</div>

        </main>

    </div>

    <!-- Confirmation Modal -->
    @livewire('auth.logout-modal')
    @stack('scripts')
    @livewireScripts
</body>

</html>