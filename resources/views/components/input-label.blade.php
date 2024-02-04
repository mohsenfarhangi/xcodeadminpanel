@props(['value','required' => false])

@php
    $class = 'form-label p-0 ps-2';
    if ($required){
        $class .= " required";
    }
@endphp
<label {{ $attributes->merge(['class' => $class]) }}>
    {{ $value ?? $slot }}
</label>
