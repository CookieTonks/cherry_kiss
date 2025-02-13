<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Dashboard de administracion
        </h2>
    </x-slot>

    <div class="container">
        <div class="py-5">

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
                            <h5 class="fw-bold">Cotizaciones abiertas</h5>
                            <h2 id="usuariosActivos">{{$budgetOpen}}</h2>
                            <a href="{{ route('export.open.budgets') }}" class="btn btn-success mt-3">Exportar a Excel</a>

                        </div>
                    </div>
                </div>


                <div class="col-12 col-sm-6 col-md-3">
                    <div class="card shadow rounded h-100 text-center p-3">
                        <div class="card-body">
                            <h5 class="fw-bold">Cotizaciones cerradas</h5>
                            <h2 id="productosVendidos">{{$budgetClosed}}</h2>
                            <a href="{{ route('export.closed.budgets') }}" class="btn btn-success mt-3">Exportar a Excel</a>
                        </div>
                    </div>
                </div>


                <div class="col-12 col-sm-6 col-md-3">
                    <div class="card shadow rounded h-100 text-center p-3">
                        <div class="card-body">
                            <h5 class="fw-bold">Cotizaciones rechazadas</h5>
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
                            <h2 id="ventasMes">85</h2>
                        </div>
                    </div>
                </div>
                <!-- Conteos -->
                <div class="col-12 col-sm-6 col-md-3">
                    <div class="card shadow rounded h-100 text-center p-3">
                        <div class="card-body">
                            <h5 class="fw-bold">Ordenes proximas a entregar</h5>
                            <h2 id="usuariosActivos">120</h2>
                        </div>
                    </div>
                </div>



                <div class="col-12 col-sm-6 col-md-3">
                    <div class="card shadow rounded h-100 text-center p-3">
                        <div class="card-body">
                            <h5 class="fw-bold">Ordenes vencidas</h5>
                            <h2 id="productosVendidos">320</h2> <!-- Conteo estático -->
                        </div>
                    </div>
                </div>

                <div class="col-12 col-sm-6 col-md-3">
                    <div class="card shadow rounded h-100 text-center p-3">
                        <div class="card-body">
                            <h5 class="fw-bold">Ordenes cerradas</h5>
                            <h2 id="productosVendidos">320</h2> <!-- Conteo estático -->
                        </div>
                    </div>
                </div>
            </div>
            <!-- Gráficas -->
        </div>



        <div class="py-5">
            <!-- Tabla de Datos -->
            <div class="card shadow">
                <div class="card-header">
                    <h5 class="card-title">Productos</h5>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Producto</th>
                                <th>Categoría</th>
                                <th>Precio</th>
                                <th>Stock</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>Producto A</td>
                                <td>Electrónica</td>
                                <td>$120</td>
                                <td>25</td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td>Producto B</td>
                                <td>Hogar</td>
                                <td>$85</td>
                                <td>45</td>
                            </tr>
                            <tr>
                                <td>3</td>
                                <td>Producto C</td>
                                <td>Moda</td>
                                <td>$45</td>
                                <td>60</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
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
                cotizaciones.push({{ $budget->total }});
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
                cotizaciones.push({{ $budget->total }});
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
                cotizaciones.push({{ $budget->total }});
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
            const meses = @json($budgetStatus->pluck('month'));
            const facturasEnviadas = @json($budgetStatus->pluck('aprobadas_en_proceso'));
            const facturasPendientes = @json($budgetStatus->pluck('rechazadas'));

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