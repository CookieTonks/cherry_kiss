<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Orden Trabajo / Materiales
        </h2>
        <div class="container">
            <div class="py-5">
                <div class="mb-3">
                    <label for="client" class="form-label">Cliente</label>
                    <input type="text" class="form-control" value="{{$budget->client->name}}" name="client" placeholder="Cliente" readonly>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="client" class="form-label">Usuario</label>
                    <input type="text" class="form-control" value="{{ $budget->clientUser->name }}" name="client" placeholder="Cliente" readonly>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="tipo" class="form-label">Moneda</label>
                    <input type="text" class="form-control" value="{{$budget->moneda}}" name="tipo" placeholder="Tipo" readonly>
                </div>
                <div class="mb-3">
                    <label for="tipo" class="form-label">Tiempo de Entrega</label>
                    <input type="text" class="form-control" value="{{$budget->delivery_time}}" name="tipo" placeholder="Tipo" readonly>
                </div>
                <div class="mb-3">
                    <label for="tipo" class="form-label">Número de Orden de Compra (OC)</label>
                    <input type="text" class="form-control" value="{{$budget->oc_number}}" name="tipo" placeholder="Tipo" readonly>
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered" id="items-table">
                        <thead>
                            <tr>
                                <th>Descripción</th>
                                <th>Cantidad</th>
                                <th>Estado</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($materials as $material)
                            <tr>
                                <td>
                                    {{ $material->descripcion }}
                                </td>
                                <td>
                                    {{ $material->cantidad }}
                                </td>

                                <td>
                                    {{ $material->estatus }}

                                </td>

                                <td class="text-center">
                                    <form action="{{ route('budgets.destroy.materials', ['materialId' => $material->id]) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm delete-row">Eliminar</button>
                                    </form>

                                    <a href="#"
                                        class="btn btn-info btn-sm"
                                        data-bs-toggle="modal"
                                        data-bs-target="#modalModifyItem"
                                        data-id="{{ $material->id }}"
                                        data-descripcion="{{ $material->descripcion }}"
                                        data-cantidad="{{ $material->cantidad }}"
                                        data-precio_unitario="{{ $material->precio_unitario }}">
                                        Editar
                                    </a>

                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <button type="button" id="add-row" class="btn btn-primary mb-3 text-end" data-bs-toggle="modal" data-bs-target="#addItemModal" onclick="openAddItemModal({{ $budget->id }})">
                        + Material
                    </button>

                </div>
            </div>
        </div>

        <!-- Modal para Agregar Material -->
        <div class="modal fade" id="addItemModal" tabindex="-1" aria-labelledby="addItemModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addItemModalLabel">Agregar Material</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('budgets.create.materials', ['budgetId' => $budget->id] ) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label for="materialName" class="form-label">Nombre del Material</label>
                                <input type="text" class="form-control" id="descripcion" name="descripcion" required>
                            </div>
                            <div class="mb-3">
                                <label for="quantity" class="form-label">Cantidad</label>
                                <input type="number" class="form-control" id="cantidad" name="cantidad" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Guardar Material</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </x-slot>
</x-app-layout>