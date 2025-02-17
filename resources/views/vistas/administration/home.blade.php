<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Dashboard de administracion
        </h2>
    </x-slot>

    <div class="container">
        <div class="py-5">
            <div class="row">
                <div class="col-12 d-flex justify-content-end gap-2 mb-3">
                    <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalProveedor">Agregar Proveedor</button>
                    <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalCliente">Agregar Cliente</button>
                    <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalUsuario">Agregar Usuario</button>
                    <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalTecnico">Agregar Empleado</button>
                </div>
            </div>
            <div class="row">

                <div class="col-12 col-sm-6 col-md-3">
                    <div class="card shadow rounded h-100 text-center p-3">
                        <div class="card-body">
                            <h5 class="fw-bold">Cotizaciones Monto</h5>
                            <h2 id="ventasMes">${{ number_format($budgetMonto, 2) }}</h2>
                            <a href="{{ route('export.general.budgets') }}" class="btn btn-success mt-3">Exportar a Excel</a>

                        </div>
                    </div>
                </div>
                <!-- Conteos -->
                <div class="col-12 col-sm-6 col-md-3">
                    <div class="card shadow rounded h-100 text-center p-3">
                        <div class="card-body">
                            <h5 class="fw-bold">Cotizaciones Abiertas</h5>
                            <h2 id="usuariosActivos">{{$budgetOpen}}</h2>
                            <a href="{{ route('export.open.budgets') }}" class="btn btn-success mt-3">Exportar a Excel</a>

                        </div>
                    </div>
                </div>


                <div class="col-12 col-sm-6 col-md-3">
                    <div class="card shadow rounded h-100 text-center p-3">
                        <div class="card-body">
                            <h5 class="fw-bold">Cotizaciones Cerradas</h5>
                            <h2 id="productosVendidos">{{$budgetClosed}}</h2>
                            <a href="{{ route('export.closed.budgets') }}" class="btn btn-success mt-3">Exportar a Excel</a>
                        </div>
                    </div>
                </div>


                <div class="col-12 col-sm-6 col-md-3">
                    <div class="card shadow rounded h-100 text-center p-3">
                        <div class="card-body">
                            <h5 class="fw-bold">Cotizaciones Rechazadas</h5>
                            <h2 id="productosVendidos">{{$budgetRejected}}</h2>
                            <a href="{{ route('export.rejected.budgets') }}" class="btn btn-success mt-3">Exportar a Excel</a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="py-12">
                <div class="row d-flex flex-wrap">
                    <div class="col-12 col-sm-6 col-md-3">
                        <div class="card shadow rounded h-100">
                            <div class="card-header">
                                <h5 class="card-title">Cotizaciones por Vendedor</h5>
                            </div>
                            <div class="card-body">
                                <canvas id="vendedoresBudget" width="100" height="50"></canvas>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-sm-6 col-md-3">
                        <div class="card shadow rounded h-100">
                            <div class="card-header">
                                <h5 class="card-title">Cotizaciones por Cliente</h5>
                            </div>
                            <div class="card-body">
                                <canvas id="clientBudget" width="100" height="50"></canvas>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-sm-6 col-md-3">
                        <div class="card shadow rounded h-100">
                            <div class="card-header">
                                <h5 class="card-title">Cotizaciones por mes </h5>
                            </div>
                            <div class="card-body">
                                <canvas id="budgetsByMonth"></canvas>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-sm-6 col-md-3">
                        <div class="card shadow rounded h-100">
                            <div class="card-header">
                                <h5 class="card-title">Cotizaciones aprobadas vs Cotizaciones rechazadas</h5>
                            </div>
                            <div class="card-body">
                                <canvas id="facturasEstadoChart"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>



            <div class="row">

                <div class="col-12 col-sm-6 col-md-3">
                    <div class="card shadow rounded h-100 text-center p-3">
                        <div class="card-body">
                            <h5 class="fw-bold">Ordenes en proceso</h5>
                            <h2 id="ventasMes">{{$itemProcess}}</h2>
                        </div>
                    </div>
                </div>
                <!-- Conteos -->
                <div class="col-12 col-sm-6 col-md-3">
                    <div class="card shadow rounded h-100 text-center p-3">
                        <div class="card-body">
                            <h5 class="fw-bold">Ordenes proximas a entregar</h5>
                            <h2 id="usuariosActivos">{{$itemToDelivery}}</h2>
                        </div>
                    </div>
                </div>



                <div class="col-12 col-sm-6 col-md-3">
                    <div class="card shadow rounded h-100 text-center p-3">
                        <div class="card-body">
                            <h5 class="fw-bold">Ordenes Vencidas</h5>
                            <h2 id="productosVendidos">{{$itemPastDelivery}}</h2> <!-- Conteo estático -->
                        </div>
                    </div>
                </div>

                <div class="col-12 col-sm-6 col-md-3">
                    <div class="card shadow rounded h-100 text-center p-3">
                        <div class="card-body">
                            <h5 class="fw-bold">Ordenes cerradas</h5>
                            <h2 id="productosVendidos">{{$itemClosed}}</h2> <!-- Conteo estático -->
                        </div>
                    </div>
                </div>
            </div>
            <!-- Gráficas -->
        </div>



        <div class="py-2">
            <div class="row">
                <div class="table-responsive">
                    <div id="toolbar">
                        <!-- <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addMaterial">
                            +
                        </button> -->
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
                                <th data-field="ot" data-sortable="true">OT</th>
                                <th data-field="cliente" data-sortable="true">Cliente</th>
                                <th data-field="descripcion" data-sortable="true">Descripcion</th>
                                <th data-field="cantidad" data-sortable="true">Cantidad</th>
                                <th data-field="estado" data-sortable="true">Estado</th>
                                <th data-field="tecnico" data-sortable="true">Fecha de entrega</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($ordenes as $orden)
                            <tr>
                                <td>OT-{{$orden->budget->id}}_{{$orden->id}}</td>
                                <td>{{$orden->budget->client->name}}</td>
                                <td>{{$orden->descripcion}}</td>
                                <td>{{$orden->cantidad}}</td>
                                <td>{{$orden->estado}}</td>
                                <td>{{$orden->budget->delivery_date}}</td>

                            </tr>

                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    </div>


    <!-- Modal Proveedor -->
    <div class="modal fade" id="modalProveedor" tabindex="-1" aria-labelledby="modalProveedorLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalProveedorLabel">Agregar Proveedor</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{route('administracion.proveedor')}}">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Nombre</label>
                            <input type="text" id="nombre" name="nombre" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Razon social</label>
                            <input type="text" id="razon_social" name="razon_social" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Direccion</label>
                            <input type="text" id="direccion" name="direccion" class="form-control" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Guardar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Cliente -->
    <div class="modal fade" id="modalCliente" tabindex="-1" aria-labelledby="modalClienteLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalClienteLabel">Agregar Cliente</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="mb-3">
                            <label class="form-label">Nombre</label>
                            <input type="text" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Teléfono</label>
                            <input type="text" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input type="text" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Direccion</label>
                            <input type="text" class="form-control" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Guardar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Técnico -->
    <div class="modal fade" id="modalTecnico" tabindex="-1" aria-labelledby="modalTecnicoLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTecnicoLabel">Agregar Empleado</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{route('administracion.empleado')}}">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Nombre</label>
                            <input type="text" id="nombre" name="nombre" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" id="email" name="email" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Password</label>
                            <input type="password" id="password" name="password" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Roles</label>
                            <select class="form-control" name="role" required>
                                @foreach ($roles as $role)
                                <option id="role" name="role" value="{{ $role->id }}">{{ $role->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Guardar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalUsuario" tabindex="-1" aria-labelledby="modalTecnicoLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTecnicoLabel">Agregar Usuario</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="mb-3">
                            <label class="form-label">Cliente</label>
                            <input type="text" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Nombre</label>
                            <input type="text" class="form-control" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Guardar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Datos desde Laravel a JavaScript
            var vendedores = [];
            var cotizaciones = [];
            @foreach($budgetsBySeller as $budget)
            vendedores.push("{{ $budget->vendedor }}");
            cotizaciones.push({
                {
                    $budget - > total
                }
            });
            @endforeach

            // Gráfico de Usuarios Registrados
            var vendedoresBudget = new Chart(document.getElementById('vendedoresBudget'), {
                type: 'bar',
                data: {
                    labels: vendedores, // Nombres de los vendedores
                    datasets: [{
                        label: 'Cotizaciones Aprobadas',
                        data: cotizaciones, // Cantidad de cotizaciones por vendedor
                        backgroundColor: '#4e73df',
                        borderColor: '#4e73df',
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            position: 'top',
                        },
                        tooltip: {
                            enabled: true,
                        }
                    }
                }
            });
        });
    </script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Datos desde Laravel a JavaScript
            var clientes = [];
            var cotizaciones = [];
            var colores = ['#ff6384', '#36a2eb', '#cc65fe', '#ffce56', '#ff9f40']; // Colores adicionales si es necesario
            @foreach($budgetsByClient as $budget)
            clientes.push("{{ $budget->cliente }}");
            cotizaciones.push({
                {
                    $budget - > total
                }
            });
            @endforeach

            // Gráfico de Ventas por Categoría (Por Cliente)
            var ventasChart = new Chart(document.getElementById('clientBudget'), {
                type: 'pie', // Tipo de gráfico circular
                data: {
                    labels: clientes, // Nombres de los clientes
                    datasets: [{
                        label: 'Ventas por Categoría',
                        data: cotizaciones, // Cotizaciones totales por cliente
                        backgroundColor: colores.slice(0, clientes.length), // Colores para cada segmento
                        borderColor: colores.slice(0, clientes.length),
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            position: 'top',
                        },
                        tooltip: {
                            enabled: true,
                        }
                    }
                }
            });
        });
    </script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Datos de Laravel a JavaScript
            var meses = [];
            var cotizaciones = [];
            @foreach($budgetsByMonth as $budget)
            meses.push("{{ $budget->month }}/{{ $budget->year }}");
            cotizaciones.push({
                {
                    $budget - > total
                }
            });
            @endforeach

            // Gráfico de Cotizaciones por Mes
            new Chart(document.getElementById("budgetsByMonth"), {
                type: "line",
                data: {
                    labels: meses, // Meses/Años obtenidos desde Laravel
                    datasets: [{
                        label: "Cotizaciones por Mes",
                        data: cotizaciones, // Total de cotizaciones por mes
                        borderColor: "#45B880", // Color de la línea
                        backgroundColor: "rgba(69, 184, 128, 0.2)", // Color de relleno (transparente)
                        borderWidth: 2,
                        fill: true // Rellenar el área bajo la línea
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: true
                        }
                    }
                }
            });
        });
    </script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Prepare the data arrays from Blade
            const meses = @json($budgetStatus - > pluck('month'));
            const facturasEnviadas = @json($budgetStatus - > pluck('aprobadas_en_proceso'));
            const facturasPendientes = @json($budgetStatus - > pluck('rechazadas'));

            // Gráfico de Facturas Enviadas vs Pendientes
            new Chart(document.getElementById("facturasEstadoChart"), {
                type: "bar", // Bar chart type
                data: {
                    labels: meses.map(month => `Mes`), // Modify as needed for the month format
                    datasets: [{
                            label: "Facturas Enviadas",
                            data: facturasEnviadas,
                            backgroundColor: "rgba(54, 162, 235, 0.7)", // Blue color
                        },
                        {
                            label: "Facturas Pendientes",
                            data: facturasPendientes,
                            backgroundColor: "rgba(255, 99, 132, 0.7)", // Red color
                        }
                    ]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: true
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        });
    </script>





</x-app-layout>