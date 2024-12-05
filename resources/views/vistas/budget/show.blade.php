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
                                    <input type="text" class="form-control" value="{{$item->descripcion}}" name="items[0][descripcion]" placeholder="Descripción" required>
                                </td>
                                <td>
                                    <input type="number" class="form-control" value="{{$item->cantidad}}" name="items[0][cantidad]" placeholder="Cantidad" required>
                                </td>
                                <td>
                                    <input type="number" class="form-control" value="{{$item->precio_unitario}}" step="0.01" name="items[0][precio_unitario]" placeholder="Precio Unitario" required>
                                </td>
                                <td>
                                    <a href="{{ asset('storage/' . $item->imagen) }}" target="_blank">Ver PDF</a>
                                </td>
                                <td class="text-center">
                                    <button type="button" class="btn btn-danger btn-sm delete-row">Eliminar</button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="py-12 text-end">
                <a href="{{ route('budgets.make', ['budgetId' => $budget->id]) }}" target="_blank" class="btn btn-success btn-sm">Crear Cotización</a>
                <a href="{{ route('budgets.edit', ['budgetId' => $budget->id]) }}" target="_blank" class="btn btn-info btn-sm">Editar Cotización</a>
                <a href="{{ route('budgets.destroy', ['budgetId' => $budget->id]) }}"
                    class="btn btn-danger btn-sm"
                    onclick="return confirm('¿Estás seguro de que deseas eliminar esta cotización?')">
                    Eliminar Cotización
                </a>
                <a href="{{ route('budgets.index') }}" class="btn btn-secondary btn-sm">Regresar</a>
            </div>
        </div>
    </x-slot>
</x-app-layout>