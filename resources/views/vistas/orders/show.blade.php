<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Orden Trabajo/ Partidas
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
                                <th>Cotizacion</th>
                                <th>Partida</th>
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
                                    {{$budget->codigo}}
                                </td>
                                <td>
                                    {{$item->partida}}
                                </td>
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
                                    <a href="{{ route('budgets.pdf.order', ['budgetId' => $budget->id, 'ItemId' => $item->id]) }}" class="btn btn-success btn-sm">
                                        Orden Trabajo
                                    </a>

                                    <a href="{{ route('budgets.show.orders', ['budgetId' => $budget->id]) }}" class="btn btn-success btn-sm">
                                        + Material
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

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




        <div class="modal fade" id="modalModifyItem" tabindex="-1" aria-labelledby="modifyItemModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modifyItemModalLabel">Editar Pa rtida</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="editItemForm" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <input type="hidden" id="editItemId" name="id"> <!-- Campo oculto para el ID -->

                            <!-- Otros campos -->
                            <div class="mb-3">
                                <label for="editDescripcion" class="form-label">Descripción</label>
                                <input type="text" class="form-control" id="editDescripcion" name="descripcion">
                            </div>
                            <div class="mb-3">
                                <label for="editCantidad" class="form-label">Cantidad</label>
                                <input type="number" class="form-control" id="editCantidad" name="cantidad">
                            </div>
                            <div class="mb-3">
                                <label for="editPrecioUnitario" class="form-label">Precio Unitario</label>
                                <input type="number" class="form-control" id="editPrecioUnitario" name="precio_unitario" step="0.01">
                            </div>
                            <div class="mb-3">
                                <label for="editPdf" class="form-label">Archivo PDF</label>
                                <div id="pdfPreview" class="mb-2">
                                    <a href="#" id="existingPdfLink" target="_blank" style="display: none;">Ver archivo actual</a>
                                </div>
                                <input type="file" class="form-control" id="editPdf" name="pdf" accept="application/pdf">
                                <small class="form-text text-muted">Sube un archivo para reemplazar el actual.</small>
                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                <button type="submit" class="btn btn-success">Guardar</button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>


        <script>
            document.addEventListener('DOMContentLoaded', () => {
                const modal = document.getElementById('modalModifyItem');
                modal.addEventListener('show.bs.modal', function(event) {
                    const button = event.relatedTarget; // Botón que activó el modal
                    const id = button.getAttribute('data-id'); // Obtener el ID del ítem

                    // Actualizar la acción del formulario
                    const form = modal.querySelector('#editItemForm');
                    form.action = `/item/update/${id}`; // Construir la URL con el ID dinámico

                    // Actualizar los campos del formulario
                    modal.querySelector('#editItemId').value = id;
                    modal.querySelector('#editDescripcion').value = button.getAttribute('data-descripcion');
                    modal.querySelector('#editCantidad').value = button.getAttribute('data-cantidad');
                    modal.querySelector('#editPrecioUnitario').value = button.getAttribute('data-precio_unitario');

                    // Manejar el PDF actual (enlace o nombre)
                    const pdfLink = modal.querySelector('#existingPdfLink');
                    const pdfPath = button.getAttribute('data-pdf');
                    if (pdfPath) {
                        pdfLink.style.display = 'block';
                        pdfLink.href = `/storage/${pdfPath}`; // Asegúrate de que esta ruta sea correcta
                        pdfLink.textContent = 'Ver archivo actual';
                    } else {
                        pdfLink.style.display = 'none';
                    }
                });
            });
        </script>
    </x-slot>
</x-app-layout>