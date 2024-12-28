<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sweets Inventory Tracker - Login</title>

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Pacifico&family=Poppins:wght@400;600&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-sweetPink min-h-screen flex items-center justify-center font-body">

    <div class="bg-white shadow-lg rounded-lg p-8 max-w-md w-full">
        <!-- Header Section -->
        <div class="text-center mb-6">
            <!-- Sweet Icon (using Heroicons) -->
            <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 mx-auto text-sweetOrange" fill="none"
                viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M12 8c-1.104 0-2 .896-2 2s.896 2 2 2 2-.896 2-2-.896-2-2-2z" />
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M6.414 6.414a2 2 0 010 2.828L5 12l1.414 1.414a2 2 0 11-2.828 2.828L2 14.828l-1.414 1.414a2 2 0 01-2.828-2.828L-0.828 12 1.586 9.586a2 2 0 012.828-2.828L5 9.172l1.414-1.414a2 2 0 012.828 0z" />
            </svg>
            <h2 class="mt-4 text-3xl font-heading text-gray-700">Sweets Inventory Login</h2>
            <p class="text-sm text-gray-500">Manage your sweets inventory effortlessly</p>
        </div>

        <!-- Display Validation and Authentication Errors -->
        @if ($errors->any())
            <div class="bg-red-100 border-l-4 border-red-500 text-red-700 px-4 py-3 rounded mb-6" role="alert">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Login Form -->
        <form action="{{ route('login_user') }}" method="POST">
            @csrf
            <!-- Email Input -->
            <div class="mb-4">
                <label for="email" class="block text-gray-700">Email Address</label>
                <input type="email" id="email" name="email" placeholder="you@example.com" value="{{ old('email') }}" required
                    class="mt-1 w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-sweetBlue">
            </div>

            <!-- Password Input -->
            <div class="mb-6">
                <label for="password" class="block text-gray-700">Password</label>
                <input type="password" id="password" name="password" placeholder="••••••••" required
                    class="mt-1 w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-sweetBlue">
            </div>

            <!-- Submit Button -->
            <button type="submit"
                class="w-full bg-sweetOrange text-white py-2 px-4 rounded-lg hover:bg-sweetPink transition duration-200 font-semibold">
                Login
            </button>
        </form>
    </div>

</body>

</html>
