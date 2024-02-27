<!--begin::Navs-->
<ul class="nav nav-stretch nav-line-tabs nav-line-tabs-2x border-transparent fs-5 fw-bold">
    @foreach($tabs as $id => $tab)
        @can($tab['can'])
            <!--begin::Nav item-->
            <li class="nav-item mt-2">
                <a data-bs-toggle="tab" href="#{{$id}}"
                   class="nav-link cursor-pointer text-active-primary ms-0 me-10 py-5 {{$tab['default'] ? "active" : ""}}">
                    {{$tab['title']}}
                </a>
            </li>
            <!--end::Nav item-->
        @endcan
    @endforeach

</ul>
<!--begin::Navs-->
