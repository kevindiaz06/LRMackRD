<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'LRMackRD') }} - Iniciar Sesión</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-gradient-to-br from-primary-50 to-secondary-100 min-h-screen">
    <div class="min-h-screen flex flex-col justify-center items-center p-6">
        <div class="mb-8 text-center">
            <h1 class="text-4xl font-bold text-primary-600 mb-2">LRMackRD</h1>
            <p class="text-secondary-600 text-lg">Sistema de Gestión de Librería</p>
        </div>

        <div class="w-full max-w-md bg-white rounded-xl shadow-xl overflow-hidden backdrop-blur-sm border border-gray-100">
            <div class="px-8 pt-8 pb-6 bg-gradient-to-r from-primary-50 to-white border-b border-gray-100">
                <h2 class="text-2xl font-bold text-primary-700 text-center">
                    Bienvenido de nuevo
                </h2>
                <p class="mt-2 text-secondary-600 text-center">Inicia sesión para acceder a tu cuenta</p>
            </div>

            <div class="p-8">
                @if (session('success'))
                    <div class="mb-6 p-4 rounded-lg bg-green-50 border-l-4 border-green-500">
                        <div class="flex">
                            <div class="flex-shrink-0">
                                <svg class="h-5 w-5 text-green-400" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                </svg>
                            </div>
                            <div class="ml-3">
                                <p class="text-sm text-green-700">{{ session('success') }}</p>
                            </div>
                        </div>
                    </div>
                @endif

                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <!-- Email Address -->
                    <div class="mb-6">
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Correo electrónico</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                    <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z" />
                                    <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z" />
                                </svg>
                            </div>
                            <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus
                                class="block w-full pl-10 pr-3 py-2.5 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-primary-300 focus:border-primary-500 focus:outline-none transition">
                        </div>
                        @error('email')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Password -->
                    <div class="mb-6">
                        <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Contraseña</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd" />
                                </svg>
                            </div>
                            <input id="password" type="password" name="password" required
                                class="block w-full pl-10 pr-3 py-2.5 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-primary-300 focus:border-primary-500 focus:outline-none transition">
                        </div>
                        @error('password')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Remember Me -->
                    <div class="flex items-center justify-between mb-6">
                        <div class="flex items-center">
                            <input id="remember" type="checkbox" name="remember"
                                class="h-4 w-4 rounded border-gray-300 text-primary-600 focus:ring-primary-500 transition">
                            <label for="remember" class="ml-2 text-sm text-gray-600">Recordarme</label>
                        </div>
                    </div>

                    <div class="flex flex-col space-y-4">
                        <button type="submit"
                            class="w-full flex justify-center py-2.5 px-4 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white bg-primary-600 hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500 transition duration-150 ease-in-out">
                            Iniciar sesión
                        </button>

                        <div class="text-center">
                            <a href="{{ route('register') }}" class="text-sm font-medium text-primary-600 hover:text-primary-700 transition">
                                ¿No tienes una cuenta? Regístrate aquí
                            </a>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div class="mt-8 text-center text-sm text-gray-500">
            &copy; {{ date('Y') }} LRMackRD. Todos los derechos reservados.
        </div>
    </div>
</body>
</html>
