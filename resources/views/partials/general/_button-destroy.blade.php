@php
    $label = $label ?? __('cpanel.destroy');
@endphp

<a class="btn btn-sm btn-link btn-destroy" data-bs-toggle="tooltip" title="{{ $label }}">
    <i class="fa fa-trash text-danger fs-4"> </i>
</a>
