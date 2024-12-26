<x-app-layout>
    <x-slot name="header">
        <div class="container">
            <div class="py-5">
                <div class="mb-3">
                    <label for="client" class="form-label">Cliente</label>
                    <input type="text" class="form-control" value="{{$budget->client->name}}" name="client" placeholder="Cliente" readonly>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="tipo" class="form-label">Tipo</label>
                    <input type="text" class="form-control" value="{{$budget->tipo}}" name="tipo" placeholder="Tipo" readonly>
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
                            @foreach($items as $item)
                            <tr>
                                <td>
                                    {{$item->descripcion}}
                                </td>
                                <td>
                                    {{$item->cantidad}}
                                </td>
                                <td>
                                    {{$item->precio_unitario}}
                                </td>
                                <td>
                                    <a href="/storage/{{ $item->imagen }}" target="_blank">Ver PDF</a>
                                </td>
                                <td class="text-center">
                                    <form action="{{ route('item.destroy', ['itemId' => $item->id]) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm delete-row">Eliminar</button>
                                    </form>

                                    <a href="#" class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#modalModifyItem">Editar</a>

                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <button type="button" id="add-row" class="btn btn-primary mb-3 text-end" data-bs-toggle="modal" data-bs-target="#addItemModal">
                    + Partida
                </button>
            </div>

            <div class="py-12 text-end">
                <a href="{{ route('budgets.index') }}" class="btn btn-secondary btn-sm">Regresar</a>
                <a href="{{ route('budgets.make', ['budgetId' => $budget->id]) }}" target="_blank" class="btn btn-success btn-sm">Crear Cotización</a>
                <a href="{{ route('budgets.edit', ['budgetId' => $budget->id]) }}" target="_blank" class="btn btn-info btn-sm">Editar Cotización</a>
                <a href="#" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#modalAssignOC">Aprobar</a>
                <a href="{{ route('budgets.destroy', ['budgetId' => $budget->id]) }}"
                    class="btn btn-danger btn-sm"
                    onclick="return confirm('¿Estás seguro de que deseas eliminar esta cotización?')">
                    Eliminar Cotización
                </a>
            </div>
        </div>


        <div class="modal fade" id="addItemModal" tabindex="-1" aria-labelledby="addItemModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addItemModalLabel">Agregar Partida</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('item.store', ['budgetId' => $budget->id] ) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label for="descripcion" class="form-label">Descripción</label>
                                <input type="text" class="form-control" id="descripcion" name="descripcion" placeholder="Descripción">
                            </div>
                            <div class="mb-3">
                                <label for="cantidad" class="form-label">Cantidad</label>
                                <input type="number" class="form-control" id="cantidad" name="cantidad" placeholder="Cantidad">
                            </div>
                            <div class="mb-3">
                                <label for="precio_unitario" class="form-label">Precio Unitario</label>
                                <input type="number" class="form-control" id="precio_unitario" name="precio_unitario" step="0.01" placeholder="Precio Unitario">
                            </div>
                            <div class="mb-3">
                                <label for="pdf" class="form-label">Archivo PDF</label>
                                <input type="file" class="form-control" id="pdf" name="pdf" accept="pdf/*">
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary mb-3" data-bs-dismiss="modal">Cerrar</button>
                                <button type="submit" class="btn btn-success mb-3">Guardar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>


        <div class="modal fade" id="modalAssignOC" tabindex="-1" aria-labelledby="modalAssignOCTitle" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalAssignOCTitle">Asignar Orden de Compra y Cotización</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form method="POST" action="{{ route('budgets.assignOC', ['budgetId' => $budget->id]) }}">
                        @csrf
                        <div class="modal-body">
                            <div class="form-check mb-3">
                                <input class="form-check-input" type="checkbox" id="assignOCCheck" name="assignOC" value="1" checked>
                                <label class="form-check-label" for="assignOCCheck">
                                    Ingresar OC del cliente
                                </label>
                            </div>
                            <div class="mb-3" id="ocInputContainer">
                                <label for="ocNumber" class="form-label">Número de Orden de Compra (OC)</label>
                                <input type="text" class="form-control" id="ocNumber" name="ocNumber">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                            <button type="submit" class="btn btn-success">Enviar a produccion</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="modal fade" id="modalModifyItem" tabindex="-1" aria-labelledby="modalModifyItemTitle" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalModifyItemTitle">Modificar partida</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form method="POST" action="{{ route('budgets.assignOC', ['budgetId' => $budget->id]) }}">
                        @csrf
                        <div class="modal-body">
                            <div class="form-check mb-3">
                                <input class="form-check-input" type="checkbox" id="assignOCCheck" name="assignOC" value="1" checked>
                                <label class="form-check-label" for="assignOCCheck">
                                    Ingresar OC del cliente
                                </label>
                            </div>
                            <div class="mb-3" id="ocInputContainer">
                                <label for="ocNumber" class="form-label">Número de Orden de Compra (OC)</label>
                                <input type="text" class="form-control" id="ocNumber" name="ocNumber">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                            <button type="submit" class="btn btn-success">Enviar a produccion</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>


        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const assignOCCheck = document.getElementById('assignOCCheck');
                const ocInputContainer = document.getElementById('ocInputContainer');

                assignOCCheck.addEventListener('change', function() {
                    if (this.checked) {
                        ocInputContainer.style.display = 'block';
                        document.getElementById('ocNumber').required = true;
                    } else {
                        ocInputContainer.style.display = 'none';
                        document.getElementById('ocNumber').required = false;
                    }
                });
            });
        </script>

    </x-slot>
</x-app-layout>