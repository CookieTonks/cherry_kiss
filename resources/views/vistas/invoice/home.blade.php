<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Facturacion / Home
        </h2>
        <div class="container">
            <div class="py-5">

                <div class="row justify-content-center">
                    <!-- Módulo 1 -->
                    <div class="col-12 col-sm-6">
                        <div class="card shadow rounded h-100 d-flex align-items-center justify-content-center">
                            <div class="card-body text-center">
                                <a href="" class="text-decoration-none text-dark fw-bold fs-5">
                                    Partidas de OC sin factura:
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-sm-6">
                        <div class="card shadow rounded h-100 d-flex align-items-center justify-content-center">
                            <div class="card-body text-center">
                                <a href="" class="text-decoration-none text-dark fw-bold fs-5">
                                    Partidas de OC en proceso:
                                </a>
                            </div>
                        </div>
                    </div>

                </div>


            </div>

            <div class="py-2">
                <div class="row">
                    <!-- Tabla existente -->
                    <div class="col-md-8">
                        <div class="table-responsive">
                            <div id="toolbar"></div>
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
                                        <th data-field="sales" data-sortable="true">Vendedor</th>
                                        <th data-field="cantidad" data-sortable="true">Descripcion</th>
                                        <th data-field="descripcion" data-sortable="true">Cantidad</th>
                                        <th data-field="status" data-sortable="true">Estado</th>
                                        <th data-field="acciones" data-sortable="true">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @foreach($partidas as $partida)
                                    <tr>
                                        <td>{{$partida->budget->oc_number}}</td>
                                        <td>{{$partida->budget->client->name}}</td>
                                        <td>{{$partida->budget->user->name}}</td>
                                        <td>{{$partida->descripcion}}</td>
                                        <td>{{$partida->cantidad}}</td>
                                        <td>{{$partida->estado}}</td>
                                        <td>hello baby firl</td>
                                    </tr>
                                    @endforeach

                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- Nueva columna para mostrar las OC -->
                    <div class="col-md-4">
                        <div class="card">
                            <!-- Encabezado de la tarjeta -->
                            <div class="card-header bg-dark text-white d-flex justify-content-between align-items-center">
                                <span>FACTURAS</span>
                                <!-- Botón alineado dentro del header -->
                                <button type="button" data-bs-toggle="modal" data-bs-target="#itemsModal" class="btn btn-primary mb-3"> + </button>
                            </div>

                            <!-- Cuerpo de la tarjeta -->
                            <div class="card-body">
                                <ul class="list-group">

                                    @foreach($facturas as $factura)
                                    <li class="list-group-item">
                                        <strong>Factura:</strong> {{ $factura->codigo }}<br>
                                        <strong>Cliente:</strong> {{ $factura->client->name }}<br>
                                        <strong>Estado:</strong> {{ $factura->estatus }}
                                        <br>
                                        <!-- Ver aqui a donde cuantas estan por factura -->
                                        <button class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#ocMaterials"
                                            onclick="loadMaterials({{ $factura->id }})">
                                            Ver Material
                                        </button>
                                        <button class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#ocMaterials"
                                            onclick="loadMaterials({{ $factura->id }})">
                                            Estatus Factura
                                        </button>


                                    </li>
                                    @endforeach


                                </ul>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

        </div>


        <div class="modal fade" id="itemsModal" tabindex="-1" aria-labelledby="modifyItemModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modifyItemModalLabel">Nueva Factura</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('invoice.alta')}}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <div class="mb-3">
                                <label for="codigo" class="form-label">Codigo</label>
                                <input type="text" class="form-control" id="codigo" name="codigo" placeholder="Codigo">
                            </div>
                            <!-- Datos de la OC -->
                            <div class="mb-3">
                                <label for="client" class="form-label">Cliente</label>

                                <select class="form-control" id="client_id" name="client_id" required>
                                    @foreach ($clientes as $cliente)
                                    <option value="{{ $cliente->id }}" required>{{ $cliente->name }}</option>
                                    @endforeach
                                </select>

                            </div>

                            <div class="mb-3">
                                <label for="razon_social" class="form-label"><strong>Razon Social:</strong></label>
                                <select class="form-control" name="razon_social" id="razon_social" required>
                                    <option value="MAQUINADOS BADILSA S.A DE C.V">MAQUINADOS BADILSA S.A DE C.V</option>
                                    <option value="RICARDO JAVIER BADILLO AMAYA">RICARDO JAVIER BADILLO AMAYA</option>
                                </select>
                            </div>



                            <div class="modal-footer">
                                <a href="" class="btn btn-secondary mb-3" style="margin-right: 15px;">Regresar</a>
                                <button type="submit" class="btn btn-success mb-3">Guardar</button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>


        <div class="modal fade" id="ocMaterials" tabindex="-1" aria-labelledby="itemsModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="itemsModalLabel">Detalles de la OC</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <table class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>OT</th>
                                    <th>Empresa</th>
                                    <th>Vendedor</th>
                                    <th>Descripcion</th>
                                    <th>Cantidad</th>
                                    <th>Precio Unitario</th>
                                    <th>Estatus</th>
                                </tr>
                            </thead>
                            <tbody id="materialTableBody">
                                <!-- Se llenará dinámicamente -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                var materialOcModal = document.getElementById('materialOc');
                materialOcModal.addEventListener('show.bs.modal', function(event) {
                    var button = event.relatedTarget; // Botón que activó el modal
                    var materialId = button.getAttribute('data-material-id'); // Obtén el ID del material desde el atributo data-material-id
                    var materialIdInput = materialOcModal.querySelector('#materialIdInput'); // Campo oculto en el formulario
                    materialIdInput.value = materialId; // Asigna el valor al input oculto
                });
            });
        </script>

        <script>
            function loadMaterials(ocId) {
                fetch(`/compras/oc/${ocId}/materials`)
                    .then(response => {
                        if (!response.ok) {
                            throw new Error('Error en la respuesta del servidor');
                        }
                        return response.json();
                    })
                    .then(materials => {
                        const tbody = document.getElementById('materialTableBody');
                        tbody.innerHTML = ''; // Limpiar datos anteriores

                        materials.forEach(material => {
                            const row = `
                        <tr>
                            <td>OT-${material.item?.budget?.id}_${material.item_id}</td>
                            <td>${material.item?.budget?.client?.name || 'N/A'}</td>
                            <td>${material.item?.budget?.user?.name || 'N/A'}</td>
                            <td>${material.descripcion || 'N/A'}</td>
                            <td>${material.cantidad || 'N/A'}</td>
                            <td>${material.oc?.codigo || 'NO OC'}</td>
                            <td>${material.estatus || 'N/A'}</td>
                        </tr>
                    `;
                            tbody.innerHTML += row;
                        });
                    })
                    .catch(error => console.error('Error al cargar los materiales:', error));
            }
        </script>






    </x-slot>
</x-app-layout>