@php
    $label = $label ?? __('cpanel.destroy');
@endphp

<a class="btn btn-sm btn-light-danger destroy-parent">
    <i class="fa fa-trash"> </i>
    <span>{{ $label }}</span>
</a>
