@if ($sortField === $field)
    @if ($sortDirection === 'asc')
        ↑
    @else
        ↓
    @endif
@endif