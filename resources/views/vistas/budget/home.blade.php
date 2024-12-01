<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Cotizaciones') }}
        </h2>
    </x-slot>

    <div class="container">
        <div class="py-5">
            <div class="row">
                <!-- Módulo 1 -->
                <div class="col-12 col-sm-4">
                    <div class="card shadow rounded h-100 d-flex align-items-center justify-content-center">
                        <div class="card-body text-center">
                            <a href="{{ route('cotizaciones.home') }}" class="text-decoration-none text-dark fw-bold fs-5">
                                Cotizaciones enviadas
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Módulo 2 -->
                <div class="col-12 col-sm-4">
                    <div class="card shadow rounded h-100 d-flex align-items-center justify-content-center">
                        <div class="card-body text-center">
                            <a href="#" class="text-decoration-none text-dark fw-bold fs-5">
                                Cotizaciones pendientes
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Módulo 3 -->
                <div class="col-12 col-sm-4">
                    <div class="card shadow rounded h-100 d-flex align-items-center justify-content-center">
                        <div class="card-body text-center">
                            <a href="#" class="text-decoration-none text-dark fw-bold fs-5">
                                Cotizaciones entregadas
                            </a>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <div class="py-2">
            <div class="row">
                <div class="table-responsive">
                    <table id="orders-table"
                        class="table table-striped table-bordered"
                        data-toggle="table"
                        data-search="true"
                        data-pagination="true"
                        data-show-columns="true"
                        data-show-refresh="true"
                        data-page-list="[5, 10, 20, All]"
                        data-toolbar="#toolbar">
                        <thead class="thead-dark">
                            <tr>
                                <th data-field="id" data-sortable="true">ID</th>
                                <th data-field="orderNumber" data-sortable="true">Cliente</th>
                                <th data-field="supplier" data-sortable="true">Vendedor</th>
                                <th data-field="status" data-sortable="true">Estado</th>
                                <th data-field="total" data-sortable="true">Monto</th>
                                <th data-field="tipo" data-sortable="true">Tipo</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>

                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    </div>



</x-app-layout>