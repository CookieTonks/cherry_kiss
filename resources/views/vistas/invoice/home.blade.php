<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Facturacion / Ordenes de Trabajo
        </h2>

    </x-slot>

    <div class="container">
        <div class="py-5">

            <div class="row justify-content-center">
                <!-- Módulo 1 -->
                <div class="col-12 col-sm-6">
                    <div class="card shadow rounded h-100 d-flex align-items-center justify-content-center">
                        <div class="card-body text-center">
                            <a href="{{ route('budgets.index', ['estado' => 'ABIERTA']) }}" class="text-decoration-none text-dark fw-bold fs-5">
                                Ordenes pendientes: {{$contador}}
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
                                <th data-field="ot" data-sortable="true">OC</th>
                                <th data-field="orderNumber" data-sortable="true">Empresa</th>
                                <th data-field="supplier" data-sortable="true">Usuario</th>
                                <th data-field="sales" data-sortable="true">Vendedor</th>
                                <th data-field="acciones" data-sortable="true">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach($ordenes as $orden)
                            <tr>
                                <td>{{$orden->oc_number}}</td>
                                <td>{{$orden->client->name}}</td>
                                <td>{{$orden->user->name}}</td>
                                <td>{{$orden->clientUser->name}}</td>
                                <td></td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    </div>





    <!-- Modales -->

</x-app-layout>