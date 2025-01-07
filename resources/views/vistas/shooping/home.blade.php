<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Compras / Home
        </h2>
        <div class="container">
            <div class="py-5">

                <div class="row justify-content-center">
                    <!-- Módulo 1 -->
                    <div class="col-12 col-sm-2">
                        <div class="card shadow rounded h-100 d-flex align-items-center justify-content-center">
                            <div class="card-body text-center">
                                <a href="{{ route('budgets.index', ['estado' => 'ABIERTA']) }}" class="text-decoration-none text-dark fw-bold fs-5">
                                    Material proceso: 
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-sm-2">
                        <div class="card shadow rounded h-100 d-flex align-items-center justify-content-center">
                            <div class="card-body text-center">
                                <a href="{{ route('budgets.index', ['estado' => 'RECHAZADAS']) }}" class="text-decoration-none text-dark fw-bold fs-5">
                                    Material proceso:
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Módulo 2 -->
                    <div class="col-12 col-sm-2">
                        <div class="card shadow rounded h-100 d-flex align-items-center justify-content-center">
                            <div class="card-body text-center">
                                <a href="{{ route('budgets.index', ['estado' => 'PENDIENTE']) }}" class="text-decoration-none text-dark fw-bold fs-5">
                                    Material pendientes: 
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Módulo 3 -->
                    <div class="col-12 col-sm-2">
                        <div class="card shadow rounded h-100 d-flex align-items-center justify-content-center">
                            <div class="card-body text-center">
                                <a href="{{ route('budgets.index', ['estado' => 'ENTREGADA']) }}" class="text-decoration-none text-dark fw-bold fs-5">
                                    Material entregadas: 
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-sm-2">
                        <div class="card shadow rounded h-100 d-flex align-items-center justify-content-center">
                            <div class="card-body text-center">
                                <a href="{{ route('budgets.index', ['estado' => 'RECHAZADAS']) }}" class="text-decoration-none text-dark fw-bold fs-5">
                                    Material rechazadas:
                                </a>
                            </div>
                        </div>
                    </div>




                </div>
            </div>

            <div class="py-2">
                <div class="row">
                    <div class="table-responsive">
                        <div id="toolbar">

                        </div>
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
                                    <th data-field="id" data-sortable="true">Codigo</th>
                                    <th data-field="orderNumber" data-sortable="true">Empresa</th>
                                    <th data-field="supplier" data-sortable="true">Usuario</th>
                                    <th data-field="sales" data-sortable="true">Vendedor</th>
                                    <th data-field="oc" data-sortable="true">OC</th>
                                    <th data-field="status" data-sortable="true">Estado</th>
                                    <th data-field="acciones" data-sortable="true">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($materiales as $material)
                                <tr>
                                    <td>{{$material->id}}</td>
                                    <td>{{$material->id}}</td>
                                    <td>{{$material->id}}</td>
                                    <td>{{$material->id}}</td>
                                    <td>{{$material->id}}</td>
                                    <td>{{$material->id}}</td>
                                    <td>
                                        <a href="{{ route('budgets.show.orders', ['budgetId' => $material->id]) }}" class="btn btn-success btn-sm">
                                            Opciones
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </x-slot>
</x-app-layout>