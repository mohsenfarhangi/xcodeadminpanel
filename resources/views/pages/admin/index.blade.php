<?php
$page = \App\Http\Core\Theme\Theme::getPageKey();
?>
<x-default-layout>

    @include('pages.' . str_replace('_', '.', $page) . '._self._table')

    @canany(['admin_create','admin_update'])
        @livewire('admin.show');
    @endif

    @section('styles')
        @livewireStyles
    @endsection
    @section('scripts')
        {{ $dataTable->scripts(attributes: ['type' => 'module']) }}
        @livewireScripts

        <script>
            let _token = '{{ csrf_token() }}',
                patch = '{!! method_field("PATCH") !!}',
                route_destroy = '{{route('admin.destroy',['id'=>'-id-'])}}',
                route_store = '{{route('admin.store')}}',
                ajax = '{{route('admin.ajax')}}';
        </script>
    @endsection


</x-default-layout>
