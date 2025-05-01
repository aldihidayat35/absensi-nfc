<!--begin::Toolbar-->
<div id="kt_app_toolbar" class="app-toolbar d-flex pb-3 pb-lg-5">
    <!--begin::Toolbar container-->
    <div class="d-flex flex-stack flex-row-fluid">
        <!--begin::Toolbar container-->
        <div class="d-flex flex-column flex-row-fluid">
            <!--begin::Toolbar wrapper-->
            <!--begin::Page title-->
            <div class="page-title d-flex align-items-center me-3">
                <!--begin::Title-->
                <h1 class="page-heading d-flex flex-column justify-content-center text-gray-900 fw-bold fs-lg-2x gap-2">
                    <span>{{ $title ?? 'Dashboard' }}</span> <!-- Dynamic Title -->
                    <!--begin::Description-->
                    <span class="page-desc text-gray-600 fs-base fw-semibold">
                        {{ $description ?? 'Welcome to your application' }}
                    </span>
                    <!--end::Description-->
                </h1>
                <!--end::Title-->
            </div>
            <!--end::Page title-->

            <!--begin::Breadcrumb-->
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="{{ route('dashboard') }}" class="text-gray-600 text-hover-primary"></a>
                    </li>
                    @if (isset($breadcrumbs))
                        @foreach ($breadcrumbs as $breadcrumb)
                            <li class="breadcrumb-item {{ $loop->last ? 'active' : '' }}">
                                @if (!$loop->last)
                                    <a href="{{ $breadcrumb['url'] }}" class="text-gray-600 text-hover-primary">{{ $breadcrumb['label'] }}</a>
                                @else
                                    {{ $breadcrumb['label'] }}
                                @endif
                            </li>
                        @endforeach
                    @endif
                </ol>
            </nav>
            <!--end::Breadcrumb-->
        </div>
        <!--end::Toolbar container-->

        <!--begin::Actions-->
        <div class="d-flex align-self-center flex-center flex-shrink-0">
            <a href="{{ route('dashboard') }}" class="btn btn-sm btn-primary d-flex flex-center ms-3 px-4 py-3">
            <i class="ki-outline ki-arrow-left fs-2"></i>
            <span>Back to Home</span>
            </a>
        </div>
        <!--end::Actions-->
    </div>
    <!--end::Toolbar container-->
</div>
<!--end::Toolbar-->
