<x-app-layout>
    <x-slot name="header">
        <div class="container">
            <div class="py-12">
                <form action="{{ route('budgets.update', ['budgetId' => $budget->id]) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <!-- Datos de la OC -->
                    <div class="mb-3">
                        <label for="client" class="form-label">Cliente</label>
                        <select class="form-control" id="client" name="client" required>
                            <option value="{{ $budget->client_id }}" selected>{{ $budget->client->name }}</option>
                            @foreach ($clients as $client)
                            <option value="{{ $client->id }}">{{ $client->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Datos de la OC -->
                    <div class="mb-3">
                        <label for="tipo" class="form-label">Tipo</label>
                        <select class="form-control" id="tipo" name="tipo" required>
                            <option value="{{ $budget->tipo }}" selected>{{ $budget->tipo }}</option>
                            <option value="urgencia">Urgencia</option>
                            <option value="generica">Generica</option>
                        </select>
                    </div>
                    <div class="modal-footer">
                        <a href="{{ route('budgets.show', ['budgetId' => $budget->id]) }}" class="btn btn-secondary mb-3" style="margin-right: 15px;">Regresar</a>
                        <button type="submit" class="btn btn-success mb-3">Guardar</button>
                    </div>
                </form>
            </div>
        </div>
</x-app-layout>