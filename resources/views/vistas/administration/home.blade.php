<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Almacen / Materiales
        </h2>

    </x-slot>
    <div class="container">
        <div class="py-5">
            <div class="row justify-content-center">
                <div class="col-xl-12">
                    <div class="row g-4">

                        <!-- Tarjeta Cliente -->
                        <div class="col-12 col-sm-6 col-md-3">
                            <div class="card shadow rounded h-100 text-center p-3">
                                <div class="card-body">
                                    <h5 class="fw-bold">Cliente</h5>
                                    <div class="d-flex justify-content-center mt-3">
                                        <button type="button" class="btn btn-primary me-2" data-toggle="modal" data-target="#alta_cliente">+</button>
                                        <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#ver_clientes">👁</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Tarjeta Proveedor -->
                        <div class="col-12 col-sm-6 col-md-3">
                            <div class="card shadow rounded h-100 text-center p-3">
                                <div class="card-body">
                                    <h5 class="fw-bold">Proveedor</h5>
                                    <div class="d-flex justify-content-center mt-3">
                                        <button type="button" class="btn btn-primary me-2" data-toggle="modal" data-target="#alta_proveedor">+</button>
                                        <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#ver_proveedores">👁</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Tarjeta Usuario -->
                        <div class="col-12 col-sm-6 col-md-3">
                            <div class="card shadow rounded h-100 text-center p-3">
                                <div class="card-body">
                                    <h5 class="fw-bold">Usuario</h5>
                                    <div class="d-flex justify-content-center mt-3">
                                        <button type="button" class="btn btn-primary me-2" data-toggle="modal" data-target="#alta_usuario">+</button>
                                        <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#ver_usuarios">👁</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Tarjeta Técnico -->
                        <div class="col-12 col-sm-6 col-md-3">
                            <div class="card shadow rounded h-100 text-center p-3">
                                <div class="card-body">
                                    <h5 class="fw-bold">Técnico</h5>
                                    <div class="d-flex justify-content-center mt-3">
                                        <button type="button" class="btn btn-primary me-2" data-toggle="modal" data-target="#alta_tecnico">+</button>
                                        <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#ver_tecnicos">👁</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>



    <div class="py-2">
        <div class="row">

        </div>
    </div>
    </div>
    </div>


    <!-- Modales -->

    <div class="modal fade" id="alta_cliente" tabindex="-1" aria-labelledby="altaClienteLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="altaClienteLabel">Alta de Cliente</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="form-group">
                            <label for="nombre_cliente">Nombre</label>
                            <input type="text" class="form-control" id="nombre_cliente">
                        </div>
                        <button type="submit" class="btn btn-primary mt-3">Guardar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>


</x-app-layout>