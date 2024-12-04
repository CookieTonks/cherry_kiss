<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Cotizaciones / {{ $estado ? ucfirst(strtolower($estado)) : 'Todas' }}
        </h2>

    </x-slot>

    <div class="container">
        <div class="py-5">
            <div class="row">
                <!-- Módulo 1 -->
                <div class="col-12 col-sm-4">
                    <div class="card shadow rounded h-100 d-flex align-items-center justify-content-center">
                        <div class="card-body text-center">
                            <a href="{{ route('budgets.index', ['estado' => 'ABIERTA']) }}" class="text-decoration-none text-dark fw-bold fs-5">
                                Cotizaciones abiertas
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Módulo 2 -->
                <div class="col-12 col-sm-4">
                    <div class="card shadow rounded h-100 d-flex align-items-center justify-content-center">
                        <div class="card-body text-center">
                            <a href="{{ route('budgets.index', ['estado' => 'PENDIENTE']) }}" class="text-decoration-none text-dark fw-bold fs-5">
                                Cotizaciones pendientes
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Módulo 3 -->
                <div class="col-12 col-sm-4">
                    <div class="card shadow rounded h-100 d-flex align-items-center justify-content-center">
                        <div class="card-body text-center">
                            <a href="{{ route('budgets.index', ['estado' => 'ENTREGADA']) }}" class="text-decoration-none text-dark fw-bold fs-5">
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
                    <div id="toolbar">
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                            +
                        </button>
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
                                <th data-field="id" data-sortable="true">ID</th>
                                <th data-field="orderNumber" data-sortable="true">Cliente</th>
                                <th data-field="supplier" data-sortable="true">Vendedor</th>
                                <th data-field="status" data-sortable="true">Estado</th>
                                <th data-field="total" data-sortable="true">Monto</th>
                                <th data-field="tipo" data-sortable="true">Tipo</th>
                                <th data-field="partidas" data-sortable="true">Partidas</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($cotizaciones as $cotizacion)
                            <tr>
                                <td>{{$cotizacion->id}}</td>
                                <td>{{ $cotizacion->client?->name ?? 'Cliente no asignado' }}</td>
                                <td>{{ $cotizacion->user?->name ?? 'Usuario no asignado' }}</td>
                                <td>{{$cotizacion->estado}}</td>
                                <td>{{$cotizacion->monto}}</td>
                                <td>{{$cotizacion->tipo}}</td>
                                <td>
                                    <!-- Botón para abrir modal -->
                                    <button class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#itemsModal"
                                        onclick="loadItems({{ $cotizacion->id }})">
                                        Ver Partidas
                                    </button>
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



    <!-- Modales -->

    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Formulario de Nueva Cotización</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('budgets.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <!-- Datos de la OC -->
                        <div class="mb-3">
                            <label for="client" class="form-label">Cliente</label>
                            <select class="form-control" id="client" name="client" required>
                                @foreach ($clientes as $cliente)
                                <option value="{{ $cliente->id }}">{{ $cliente->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Datos de la OC -->
                        <div class="mb-3">
                            <label for="tipo" class="form-label">Tipo</label>
                            <select class="form-control" id="tipo" name="tipo" required>
                                <option value="urgencia">Urgencia</option>
                                <option value="generica">Generica</option>
                            </select>
                        </div>

                        <div class="table-responsive">
                            <table class="table table-bordered" id="items-table">
                                <thead>
                                    <tr>
                                        <th>Descripción</th>
                                        <th>Cantidad</th>
                                        <th>P/U</th>
                                        <th>PDF</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- Fila inicial de ejemplo -->
                                    <tr>
                                        <td>
                                            <input type="text" class="form-control" name="items[0][descripcion]" placeholder="Descripción" required>
                                        </td>
                                        <td>
                                            <input type="number" class="form-control" name="items[0][cantidad]" placeholder="Cantidad" required>
                                        </td>
                                        <td>
                                            <input type="number" class="form-control" step="0.01" name="items[0][precio_unitario]" placeholder="Precio Unitario" required>
                                        </td>
                                        <td>
                                            <input type="file" class="form-control" name="items[0][pdf]" accept="pdf/*">
                                        </td>
                                        <td class="text-center">
                                            <button type="button" class="btn btn-danger btn-sm delete-row">Eliminar</button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <!-- Botón para agregar filas -->
                        <button type="button" id="add-row" class="btn btn-primary mb-3"> + Partida</button>
                        <button type="submit" class="btn btn-success mb-3">Guardar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" id="itemsModal" tabindex="-1" aria-labelledby="itemsModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="itemsModalLabel">Detalles del Presupuesto</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>Descripción</th>
                                <th>Cantidad</th>
                                <th>Precio Unitario</th>
                                <th>Subtotal</th>
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
        let itemIndex = 1;

        // Agregar fila
        document.getElementById('add-row').addEventListener('click', () => {
            const tableBody = document.querySelector('#items-table tbody');
            const newRow = `
            <tr>
                <td>
                    <input type="text" class="form-control" name="items[${itemIndex}][descripcion]" placeholder="Descripción">
                </td>
                <td>
                    <input type="number" class="form-control" name="items[${itemIndex}][cantidad]" placeholder="Cantidad">
                </td>
                <td>
                    <input type="number" class="form-control" step="0.01" name="items[${itemIndex}][precio_unitario]" placeholder="Precio Unitario">
                </td>
                <td>
                    <input type="file" class="form-control" name="items[0][pdf]" accept="pdf/*">
                </td>
                <td class="text-center">
                    <button type="button" class="btn btn-danger btn-sm delete-row">-</button>
                </td>
            </tr>
        `;
            tableBody.insertAdjacentHTML('beforeend', newRow);
            itemIndex++;
        });

        // Eliminar fila
        document.querySelector('#items-table').addEventListener('click', (event) => {
            if (event.target.classList.contains('delete-row')) {
                const row = event.target.closest('tr');
                row.remove();
            }
        });
    </script>

    <script>
        function loadItems(budgetId) {
            // Realiza una solicitud AJAX para obtener los items del presupuesto
            fetch(`/budgets/${budgetId}/items`)
                .then(response => response.json())
                .then(items => {
                    const tbody = document.getElementById('itemsTableBody');
                    tbody.innerHTML = ''; // Limpiar datos anteriores
                    items.forEach(item => {
                        const row = `
                    <tr>
                        <td>${item.descripcion}</td>
                        <td>${item.cantidad}</td>
                        <td>${item.precio_unitario}</td>
                        <td>${item.subtotal}</td>
                    </tr>
                `;
                        tbody.innerHTML += row;
                    });
                })
                .catch(error => console.error('Error al cargar los items:', error));
        }
    </script>
</x-app-layout>