<?php
$page = 'driver.profile';

?>
<x-default-layout>
    @section('styles')

    @endsection
    @section('scripts')

        <script>
            let _token = '{{ csrf_token() }}',
                ajax = '{{ route('user.profile.ajax') }}',
                patch = '{!! method_field("PATCH") !!}';
        </script>
    @endsection

        <input type="hidden" name="user_id" value="{{$id}}">
    @include("pages.user-profile.sections.navbar")
    @include("pages.user-profile.sections.tabs")
</x-default-layout>
