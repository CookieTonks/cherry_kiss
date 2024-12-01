<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
    <div class="container">

        <div class="py-12">
            <div class="row">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        {{ __("¡Bienvenido!") }}
                    </div>
                </div>
            </div>
        </div>

        <div class="py-1">
            <div class="row">
                <!-- Módulo 1 -->
                <div class="col-12 col-sm-4">
                    <div class="card shadow rounded h-100 d-flex align-items-center justify-content-center">
                        <div class="card-body text-center">
                            <a href="{{ route('cotizaciones.home') }}" class="text-decoration-none text-dark fw-bold fs-5">
                                Cotizaciones
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Módulo 2 -->
                <div class="col-12 col-sm-4">
                    <div class="card shadow rounded h-100 d-flex align-items-center justify-content-center">
                        <div class="card-body text-center">
                            <a href="{{ route('ordenes.home') }}" class="text-decoration-none text-dark fw-bold fs-5">
                                Ordenes
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Módulo 3 -->
                <div class="col-12 col-sm-4">
                    <div class="card shadow rounded h-100 d-flex align-items-center justify-content-center">
                        <div class="card-body text-center">
                            <a href="{{ route('roles.home') }}" class="text-decoration-none text-dark fw-bold fs-5">
                                Permisos</a>
                        </div>
                    </div>
                </div>

            </div>
        </div>

    </div>


</x-app-layout>