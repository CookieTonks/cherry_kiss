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
                            <h2 id="ventasMes">$85,000.00</h2>
                            <a href="{{ route('export.general.budgets') }}" class="btn btn-success mt-3">Exportar a Excel</a>

                        </div>
                    </div>
                </div>
                <!-- Conteos -->
                <div class="col-12 col-sm-6 col-md-3">
                    <div class="card shadow rounded h-100 text-center p-3">
                        <div class="card-body">
                            <h5 class="fw-bold">Cotizaciones abiertas</h5>
                            <h2 id="usuariosActivos">120</h2>
                            <a href="{{ route('export.closed.budgets') }}" class="btn btn-success mt-3">Exportar a Excel</a>

                        </div>
                    </div>
                </div>


                <div class="col-12 col-sm-6 col-md-3">
                    <div class="card shadow rounded h-100 text-center p-3">
                        <div class="card-body">
                            <h5 class="fw-bold">Cotizaciones cerradas</h5>
                            <h2 id="productosVendidos">320</h2>
                            <a href="{{ route('export.open.budgets') }}" class="btn btn-success mt-3">Exportar a Excel</a>
                        </div>
                    </div>
                </div>


                <div class="col-12 col-sm-6 col-md-3">
                    <div class="card shadow rounded h-100 text-center p-3">
                        <div class="card-body">
                            <h5 class="fw-bold">Cotizaciones rechazadas</h5>
                            <h2 id="productosVendidos">320</h2>
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
                                <canvas id="usuariosChart" width="100" height="50"></canvas>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-sm-6 col-md-3">
                        <div class="card shadow rounded h-100">
                            <div class="card-header">
                                <h5 class="card-title">Cotizaciones por Cliente</h5>
                            </div>
                            <div class="card-body">
                                <canvas id="ventasChart" width="100" height="50"></canvas>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-sm-6 col-md-3">
                        <div class="card shadow rounded h-100">
                            <div class="card-header">
                                <h5 class="card-title">Cotizaciones por mes </h5>
                            </div>
                            <div class="card-body">
                                <canvas id="facturasPagadasChart"></canvas>
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
            // Datos de ejemplo (puedes reemplazarlos con datos reales desde backend)
            const meses = ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"];

            // Facturas pagadas por mes (ejemplo)
            const facturasPagadas = [10, 15, 20, 18, 25, 30, 28, 35, 40, 42, 38, 45];

            // Facturas enviadas y pendientes por mes
            const facturasEnviadas = [20, 25, 30, 28, 35, 40, 38, 45, 50, 55, 52, 60];
            const facturasPendientes = facturasEnviadas.map((env, i) => env - facturasPagadas[i]);

            // Gráfico de Facturas Pagadas
            new Chart(document.getElementById("facturasPagadasChart"), {
                type: "line",
                data: {
                    labels: meses,
                    datasets: [{
                        label: "Facturas Pagadas",
                        data: facturasPagadas,
                        borderColor: "#45B880",
                        backgroundColor: "rgba(69, 184, 128, 0.2)",
                        borderWidth: 2,
                        fill: true
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

            // Gráfico de Facturas Enviadas vs Pendientes
            new Chart(document.getElementById("facturasEstadoChart"), {
                type: "bar",
                data: {
                    labels: meses,
                    datasets: [{
                            label: "Facturas Enviadas",
                            data: facturasEnviadas,
                            backgroundColor: "rgba(54, 162, 235, 0.7)"
                        },
                        {
                            label: "Facturas Pendientes",
                            data: facturasPendientes,
                            backgroundColor: "rgba(255, 99, 132, 0.7)"
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

    <script>
        // Gráfico de Usuarios Registrados
        var usuariosChart = new Chart(document.getElementById('usuariosChart'), {
            type: 'bar', // Cambiar tipo de gráfico si es necesario
            data: {
                labels: ['Vendedor 1', 'Vendedor 2', 'Vendedor 3'],
                datasets: [{
                    label: 'Cotizaciones Aprobadadas',
                    data: [120, 150, 180],
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

        // Gráfico de Ventas por Categoría
        var ventasChart = new Chart(document.getElementById('ventasChart'), {
            type: 'pie', // Gráfico circular
            data: {
                labels: ['Empresa 1', 'Empresa 2', 'Empresa 3'],
                datasets: [{
                    label: 'Ventas por Categoría',
                    data: [55, 25, 20],
                    backgroundColor: ['#ff6384', '#36a2eb', '#cc65fe'],
                    borderColor: ['#ff6384', '#36a2eb', '#cc65fe'],
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
    </script>
</x-app-layout>