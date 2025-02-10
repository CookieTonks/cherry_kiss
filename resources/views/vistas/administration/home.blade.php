<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Dashboard de administracion
        </h2>
    </x-slot>

    <div class="container">
        <div class="py-5">
            <div class="row">
                <!-- Conteos -->
                <div class="col-12 col-sm-6 col-md-3">
                    <div class="card shadow rounded h-100 text-center p-3">
                        <div class="card-body">
                            <h5 class="fw-bold">Usuarios Activos</h5>
                            <h2 id="usuariosActivos">120</h2>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-sm-6 col-md-3">
                    <div class="card shadow rounded h-100 text-center p-3">
                        <div class="card-body">
                            <h5 class="fw-bold">Ventas del Mes</h5>
                            <h2 id="ventasMes">85</h2>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-sm-6 col-md-3">
                    <div class="card shadow rounded h-100 text-center p-3">
                        <div class="card-body">
                            <h5 class="fw-bold">Productos Vendidos</h5>
                            <h2 id="productosVendidos">320</h2> <!-- Conteo estático -->
                        </div>
                    </div>
                </div>

                <div class="col-12 col-sm-6 col-md-3">
                    <div class="card shadow rounded h-100 text-center p-3">
                        <div class="card-body">
                            <h5 class="fw-bold">Productos Vendidos</h5>
                            <h2 id="productosVendidos">320</h2> <!-- Conteo estático -->
                        </div>
                    </div>
                </div>
            </div>
            <!-- Gráficas -->
            <div class="py-5">
                <div class="row">

                    <div class="col-12 col-sm-6 col-md-3">
                        <div class="card shadow rounded h-100">
                            <div class="card-header">
                                <h5 class="card-title">Usuarios Registrados</h5>
                            </div>
                            <div class="card-body">
                                <canvas id="usuariosChart" width="100" height="50"></canvas>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-sm-6 col-md-3">
                        <div class="card shadow rounded h-100">
                            <div class="card-header">
                                <h5 class="card-title">Ventas por Categoría</h5>
                            </div>
                            <div class="card-body">
                                <canvas id="ventasChart" width="100" height="50"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
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
        // Gráfico de Usuarios Registrados
        var usuariosChart = new Chart(document.getElementById('usuariosChart'), {
            type: 'bar', // Cambiar tipo de gráfico si es necesario
            data: {
                labels: ['Enero', 'Febrero', 'Marzo'],
                datasets: [{
                    label: 'Usuarios Registrados',
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
                labels: ['Electrónica', 'Hogar', 'Moda'],
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