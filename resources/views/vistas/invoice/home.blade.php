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
                                <th data-field="partidas" data-sortable="true">Partidas</th>
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
                                <td>
                                    <button class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#itemsModal"
                                        onclick="loadItems({{ $orden->id }})">
                                        Ver Partidas
                                    </button>
                                </td>
                                <td>
                                    <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#modalFactura{{ $orden->id }}">
                                        Opciones
                                    </button>
                                    <div class="modal fade" id="modalFactura{{ $orden->id }}" tabindex="-1" aria-labelledby="modalFacturaLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="modalFacturaLabel">Alta de Factura</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="{{ route('oc_number.factura', $orden->id) }}" method="POST">
                                                        @csrf
                                                        <div class="mb-3">
                                                            <label for="numero_factura" class="form-label">Número de Factura</label>
                                                            <input type="text" class="form-control" id="numero_factura" name="numero_factura" required>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="fecha_factura" class="form-label">Fecha de Factura</label>
                                                            <input type="date" class="form-control" id="fecha_factura" name="fecha_factura" required>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="monto" class="form-label">Monto</label>
                                                            <input type="number" class="form-control" id="monto" name="monto" step="0.01" required>
                                                        </div>
                                                        <button type="submit" class="btn btn-primary">Guardar Factura</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </td>
                            </tr>
                            @endforeach
                        </tbody>

                    </table>
                </div>
            </div>
        </div>
    </div>
    </div>


    <div class="modal fade" id="itemsModal" tabindex="-1" aria-labelledby="itemsModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="itemsModalLabel">Detalles de la cotizacion</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>Cotizacion</th>
                                <th>Partida</th>
                                <th>Descripción</th>
                                <th>Cantidad</th>
                                <th>Precio Unitario</th>
                                <th>Subtotal</th>
                                <th>Estatus</th>
                                <th>PDF</th>
                            </tr>
                        </thead>
                        <tbody id="itemsTableBody">
                            <!-- Se llenará dinámicamente -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>


    <script>
        function loadItems(budgetId) {

            fetch(`/budgets/${budgetId}/items`)
                .then(response => response.json())
                .then(items => {
                    const tbody = document.getElementById('itemsTableBody');
                    tbody.innerHTML = ''; // Limpiar datos anteriores
                    items.forEach(item => {
                        const row = `
                    <tr>
                        <td>COT - ${budgetId}</td>
                        <td>${item.partida}</td>
                        <td>${item.descripcion}</td>
                        <td>${item.cantidad}</td>
                        <td>${item.precio_unitario}</td>
                        <td>${item.subtotal}</td>
                        <td>${item.estado}</td>
                        <td>
                            <a href="/storage/${item.imagen}" target="_blank">Ver PDF</a>
                        </td>
                    </tr>
                `;
                        tbody.innerHTML += row;
                    });
                })
                .catch(error => console.error('Error al cargar los items:', error));
        }
    </script>
    <!-- Modales -->

</x-app-layout>