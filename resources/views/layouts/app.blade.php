<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Sistema de Gestión de Librería') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased min-h-screen bg-gray-50">
    <div class="flex h-screen bg-gray-50">
        <!-- Sidebar -->
        <aside class="z-20 hidden w-64 overflow-y-auto bg-white md:block flex-shrink-0 shadow-lg border-r border-gray-100">
            <div class="py-6 px-4 text-gray-600">
                <a class="flex items-center justify-center mb-6" href="{{ route('dashboard') }}">
                    <span class="text-2xl font-bold text-primary-600">LRMackRD</span>
                </a>

                <div class="mb-4 px-4">
                    <div class="flex items-center space-x-3 bg-primary-50 rounded-lg p-3">
                        <img class="h-9 w-9 rounded-full object-cover border-2 border-primary-300"
                            src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=0284c7&color=fff"
                            alt="{{ Auth::user()->name }}">
                        <div>
                            <p class="text-sm font-medium text-gray-700">{{ Auth::user()->name }}</p>
                            <p class="text-xs text-gray-500 truncate">{{ Auth::user()->email }}</p>
                        </div>
                    </div>
                </div>

                <nav class="mt-6">
                    <ul class="space-y-1">
                        <li>
                            <a class="flex items-center px-4 py-2.5 text-sm font-medium rounded-lg text-gray-700 hover:bg-primary-50 hover:text-primary-700 transition-all duration-200"
                               href="{{ route('dashboard') }}">
                                <svg class="w-5 h-5 mr-3 text-gray-500" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"></path>
                                </svg>
                                <span>Dashboard</span>
                            </a>
                        </li>

                        <li class="pt-2">
                            <p class="px-4 py-1 text-xs font-semibold text-gray-400 uppercase">Gestión</p>
                        </li>

                        <li>
                            <a class="flex items-center px-4 py-2.5 text-sm font-medium rounded-lg text-gray-700 hover:bg-primary-50 hover:text-primary-700 transition-all duration-200"
                               href="{{ route('categorias.index') }}">
                                <svg class="w-5 h-5 mr-3 text-gray-500" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M7 3a1 1 0 000 2h6a1 1 0 100-2H7zM4 7a1 1 0 011-1h10a1 1 0 110 2H5a1 1 0 01-1-1zM2 11a2 2 0 012-2h12a2 2 0 012 2v4a2 2 0 01-2 2H4a2 2 0 01-2-2v-4z"></path>
                                </svg>
                                <span>Categorías</span>
                            </a>
                        </li>

                        <li>
                            <a class="flex items-center px-4 py-2.5 text-sm font-medium rounded-lg text-gray-700 hover:bg-primary-50 hover:text-primary-700 transition-all duration-200"
                               href="{{ route('proveedores.index') }}">
                                <svg class="w-5 h-5 mr-3 text-gray-500" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" d="M6 6V5a3 3 0 013-3h2a3 3 0 013 3v1h2a2 2 0 012 2v3.57A22.952 22.952 0 0110 13a22.95 22.95 0 01-8-1.43V8a2 2 0 012-2h2zm2-1a1 1 0 011-1h2a1 1 0 011 1v1H8V5zm1 5a1 1 0 011-1h.01a1 1 0 110 2H10a1 1 0 01-1-1z" clip-rule="evenodd"></path>
                                    <path d="M2 13.692V16a2 2 0 002 2h12a2 2 0 002-2v-2.308A24.974 24.974 0 0110 15c-2.796 0-5.487-.46-8-1.308z"></path>
                                </svg>
                                <span>Proveedores</span>
                            </a>
                        </li>

                        <li>
                            <a class="flex items-center px-4 py-2.5 text-sm font-medium rounded-lg text-gray-700 hover:bg-primary-50 hover:text-primary-700 transition-all duration-200"
                               href="{{ route('libros.index') }}">
                                <svg class="w-5 h-5 mr-3 text-gray-500" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M9 4.804A7.968 7.968 0 005.5 4c-1.255 0-2.443.29-3.5.804v10A7.969 7.969 0 015.5 14c1.669 0 3.218.51 4.5 1.385A7.962 7.962 0 0114.5 14c1.255 0 2.443.29 3.5.804v-10A7.968 7.968 0 0014.5 4c-1.255 0-2.443.29-3.5.804V12a1 1 0 11-2 0V4.804z"></path>
                                </svg>
                                <span>Libros</span>
                            </a>
                        </li>

                        <li>
                            <a class="flex items-center px-4 py-2.5 text-sm font-medium rounded-lg text-gray-700 hover:bg-primary-50 hover:text-primary-700 transition-all duration-200"
                               href="{{ route('clientes.index') }}">
                                <svg class="w-5 h-5 mr-3 text-gray-500" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-3a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v3h-3zM4.75 12.094A5.973 5.973 0 004 15v3H1v-3a3 3 0 013.75-2.906z"></path>
                                </svg>
                                <span>Clientes</span>
                            </a>
                        </li>

                        <li>
                            <a class="flex items-center px-4 py-2.5 text-sm font-medium rounded-lg text-gray-700 hover:bg-primary-50 hover:text-primary-700 transition-all duration-200"
                               href="{{ route('empleados.index') }}">
                                <svg class="w-5 h-5 mr-3 text-gray-500" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"></path>
                                </svg>
                                <span>Empleados</span>
                            </a>
                        </li>

                        <li class="pt-2">
                            <p class="px-4 py-1 text-xs font-semibold text-gray-400 uppercase">Operaciones</p>
                        </li>

                        <li>
                            <a class="flex items-center px-4 py-2.5 text-sm font-medium rounded-lg text-gray-700 hover:bg-primary-50 hover:text-primary-700 transition-all duration-200"
                               href="{{ route('ventas.index') }}">
                                <svg class="w-5 h-5 mr-3 text-gray-500" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" d="M10 2a4 4 0 00-4 4v1H5a1 1 0 00-.994.89l-1 9A1 1 0 004 18h12a1 1 0 00.994-1.11l-1-9A1 1 0 0015 7h-1V6a4 4 0 00-4-4zm2 5V6a2 2 0 10-4 0v1h4zm-6 3a1 1 0 112 0 1 1 0 01-2 0zm7-1a1 1 0 100 2 1 1 0 000-2z" clip-rule="evenodd"></path>
                                </svg>
                                <span>Ventas</span>
                            </a>
                        </li>

                        <li>
                            <a class="flex items-center px-4 py-2.5 text-sm font-medium rounded-lg text-gray-700 hover:bg-primary-50 hover:text-primary-700 transition-all duration-200"
                               href="{{ route('pagos.index') }}">
                                <svg class="w-5 h-5 mr-3 text-gray-500" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M4 4a2 2 0 00-2 2v1h16V6a2 2 0 00-2-2H4z"></path>
                                    <path fill-rule="evenodd" d="M18 9H2v5a2 2 0 002 2h12a2 2 0 002-2V9zM4 13a1 1 0 011-1h1a1 1 0 110 2H5a1 1 0 01-1-1zm5-1a1 1 0 100 2h1a1 1 0 100-2H9z" clip-rule="evenodd"></path>
                                </svg>
                                <span>Pagos</span>
                            </a>
                        </li>

                        <li>
                            <a class="flex items-center px-4 py-2.5 text-sm font-medium rounded-lg text-gray-700 hover:bg-primary-50 hover:text-primary-700 transition-all duration-200"
                               href="{{ route('inventarios.index') }}">
                                <svg class="w-5 h-5 mr-3 text-gray-500" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M5 3a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2V5a2 2 0 00-2-2H5zM5 11a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2v-2a2 2 0 00-2-2H5zM11 5a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V5zM11 13a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path>
                                </svg>
                                <span>Inventario</span>
                            </a>
                        </li>

                        <li>
                            <a class="flex items-center px-4 py-2.5 text-sm font-medium rounded-lg text-gray-700 hover:bg-primary-50 hover:text-primary-700 transition-all duration-200"
                               href="{{ route('facturas.index') }}">
                                <svg class="w-5 h-5 mr-3 text-gray-500" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4zm2 6a1 1 0 011-1h6a1 1 0 110 2H7a1 1 0 01-1-1zm1 3a1 1 0 100 2h6a1 1 0 100-2H7z" clip-rule="evenodd"></path>
                                </svg>
                                <span>Facturas</span>
                            </a>
                        </li>

                        <li>
                            <a class="flex items-center px-4 py-2.5 text-sm font-medium rounded-lg text-gray-700 hover:bg-primary-50 hover:text-primary-700 transition-all duration-200"
                               href="{{ route('reportes.index') }}">
                                <svg class="w-5 h-5 mr-3 text-gray-500" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" d="M3 3a1 1 0 000 2v8a2 2 0 002 2h2.586l-1.293 1.293a1 1 0 101.414 1.414L10 15.414l2.293 2.293a1 1 0 001.414-1.414L12.414 15H15a2 2 0 002-2V5a1 1 0 100-2H3zm11 4a1 1 0 10-2 0v4a1 1 0 102 0V7zm-3 1a1 1 0 10-2 0v3a1 1 0 102 0V8zM8 9a1 1 0 00-2 0v2a1 1 0 102 0V9z" clip-rule="evenodd"></path>
                                </svg>
                                <span>Reportes</span>
                            </a>
                        </li>

                        <li class="pt-2">
                            <p class="px-4 py-1 text-xs font-semibold text-gray-400 uppercase">Administración</p>
                        </li>

                        <li>
                            <a class="flex items-center px-4 py-2.5 text-sm font-medium rounded-lg text-gray-700 hover:bg-primary-50 hover:text-primary-700 transition-all duration-200"
                               href="{{ route('register') }}">
                                <svg class="w-5 h-5 mr-3 text-gray-500" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M8 9a3 3 0 100-6 3 3 0 000 6zM8 11a6 6 0 016 6H2a6 6 0 016-6zM16 7a1 1 0 10-2 0v1h-1a1 1 0 100 2h1v1a1 1 0 102 0v-1h1a1 1 0 100-2h-1V7z"></path>
                                </svg>
                                <span>Crear Usuario</span>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
        </aside>

        <div class="flex flex-col flex-1 w-full">
            <!-- Header -->
            <header class="z-10 py-3 bg-white shadow-sm border-b border-gray-100">
                <div class="container flex items-center justify-between h-full px-6 mx-auto">
                    <!-- Mobile hamburger -->
                    <button class="p-1.5 mr-5 -ml-1 rounded-lg md:hidden focus:outline-none focus:ring-2 focus:ring-gray-200">
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z" clip-rule="evenodd"></path>
                        </svg>
                    </button>

                    <!-- Search input -->
                    <div class="flex justify-center flex-1 lg:mr-32">
                        <div class="relative w-full max-w-xl">
                            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                <svg class="w-5 h-5 text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd"></path>
                                </svg>
                            </div>
                            <input class="w-full pl-10 pr-3 py-2 text-sm text-gray-700 placeholder-gray-500 bg-gray-50 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-300 focus:border-transparent"
                                   type="text" placeholder="Buscar..." aria-label="Buscar">
                        </div>
                    </div>

                    <div class="flex items-center space-x-3">
                        <!-- Notifications -->
                        <button class="p-2 rounded-lg bg-gray-50 text-gray-500 hover:text-primary-600 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-primary-300">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path d="M10 2a6 6 0 00-6 6v3.586l-.707.707A1 1 0 004 14h12a1 1 0 00.707-1.707L16 11.586V8a6 6 0 00-6-6zM10 18a3 3 0 01-3-3h6a3 3 0 01-3 3z"></path>
                            </svg>
                        </button>

                        <!-- Separator -->
                        <div class="w-px h-6 bg-gray-300"></div>

                        <!-- Profile -->
                        <div class="relative">
                            <div class="flex items-center space-x-3">
                                <div class="hidden md:block">
                                    <p class="text-sm font-medium text-gray-700">{{ Auth::user()->name }}</p>
                                </div>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="inline-flex items-center justify-center px-3 py-2 text-sm font-medium leading-4 text-white bg-primary-600 rounded-lg shadow-sm hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500 transition">
                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                                        </svg>
                                        Salir
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Main content -->
            <main class="h-full overflow-y-auto bg-gray-50">
                <div class="container px-6 py-6 mx-auto">
                    @yield('content')
                </div>
            </main>
        </div>
    </div>
</body>
</html>
