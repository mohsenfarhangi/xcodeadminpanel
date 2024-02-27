@php
    $breadcrumb = \App\Http\Core\Adapters\Bootstrap::getBreadcrumb();

    $baseClass = 'align-items-center me-3';
    $attr = array();
@endphp

<!--begin::Page title-->
<div {{ theme()->printHtmlAttributes("page-title") }} class="page-title d-flex flex-column align-items-start justify-content-center flex-wrap me-lg-20 py-3 py-lg-0 me-3">
    <!--begin::Heading-->
    <h1 class="d-flex flex-column text-dark fw-bold my-1">
        <span class="fs-1">
            {{ __(theme()->getOption('page', 'title')) }}
        </span>
    </h1>
    <!--end::Heading-->
    @if ( theme()->getOption('layout', 'page-title/breadcrumb') === true && !empty($breadcrumb))
        <!--begin::Breadcrumb-->
        <ul class="breadcrumb breadcrumb-line fw-semibold fs-7 my-1">
            @foreach ($breadcrumb as $item)
                    <?php
                    if ($item['title'] == 'home')
                        $item['title'] = __('cpanel.'.$item['title']);
                    ?>
                    <!--begin::Item-->
                @if ( $item['active'] === true )
                    <li class="breadcrumb-item text-gray-600">
                        {{ $item['title'] }}
                    </li>
                @else
                    <li class="breadcrumb-item text-muted">
                        @if ( ! empty($item['path']) )
                            <a href="{{ theme()->getPageUrl($item['path']) }}" class="text-gray-600">
                                {{ $item['title'] }}
                            </a>
                        @else
                            {{ $item['title'] }}
                        @endif
                    </li>
                @endif
                <!--end::Item-->
            @endforeach
        </ul>
        <!--end::Breadcrumb-->
    @endif
</div>
