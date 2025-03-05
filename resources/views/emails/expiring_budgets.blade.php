<x-mail::message>
# Cotizaciones proximas a entregar

Las siguientes cotizaciones tienen fecha de entrega los proximos **7 dias**:

<x-mail::table>
| COT  | Cliente | Usuario | Vendedor | Fecha de Creación |
|-----|---------|---------| ---------|-------------------|
@foreach ($budgets as $budget)
| COT- {{ $budget->id }} | {{ $budget->client?->name }} | {{ $budget->user?->name }} | {{ $budget->clientUser?->name }} |{{ $budget->created_at->format('d/m/Y') }} |
@endforeach
</x-mail::table>

Por favor, revisarlos lo antes posible.

Gracias.
</x-mail::message>
