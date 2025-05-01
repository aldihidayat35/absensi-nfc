@php
    $userLevel = session('user_level');
@endphp
<!--begin::Links-->
<div class="mb-0">
    <!--begin::Title-->
    <!--end::Title-->
    <!--begin::Row-->
    <div class="row g-5" data-kt-buttons="true" data-kt-buttons-target="[data-kt-button]">
        {{-- ==================================ADMIN============================================================================================================= --}}

        @if ($userLevel === 'admin')
            <h3 class="text-gray-800 fw-bold mb-4">Data Master</h3>
            <!--begin::Col-->
            <div class="col-6">
                <!--begin::Link-->
                <a href="{{ route('students.index') }}"
                    class="btn btn-icon btn-outline btn-bg-light btn-active-light-primary btn-flex flex-column flex-center w-100px h-100px border-gray-200"
                    data-kt-button="true">
                    <!--begin::Icon-->
                    <span class="mb-2">
                        <i class="ki-outline ki-user fs-1"></i>
                    </span>
                    <!--end::Icon-->
                    <!--begin::Label-->
                    <span class="fs-7 fw-bold">Students</span>
                    <!--end::Label-->
                </a>
                <!--end::Link-->
            </div>
            <!--end::Col-->
            <!--begin::Col-->
            <div class="col-6">
                <!--begin::Link-->
                <a href="{{ route('teachers.index') }}"
                    class="btn btn-icon btn-outline btn-bg-light btn-active-light-primary btn-flex flex-column flex-center w-100px h-100px border-gray-200"
                    data-kt-button="true">
                    <!--begin::Icon-->
                    <span class="mb-2">
                        <i class="ki-outline ki-teacher fs-1"></i>
                    </span>
                    <!--end::Icon-->
                    <!--begin::Label-->
                    <span class="fs-7 fw-bold">Teachers</span>
                    <!--end::Label-->
                </a>
                <!--end::Link-->
            </div>
            <!--end::Col-->
            <!--begin::Col-->
            <div class="col-6">
                <!--begin::Link-->
                <a href="{{ route('classrooms.index') }}"
                    class="btn btn-icon btn-outline btn-bg-light btn-active-light-primary btn-flex flex-column flex-center w-100px h-100px border-gray-200"
                    data-kt-button="true">
                    <!--begin::Icon-->
                    <span class="mb-2">
                        <i class="ki-outline ki-book fs-1"></i> <!-- Ikon buku -->
                    </span>
                    <!--end::Icon-->
                    <!--begin::Label-->
                    <span class="fs-7 fw-bold">Classrooms</span>
                    <!--end::Label-->
                </a>
                <!--end::Link-->
            </div>
            <!--end::Col-->

            <!--begin::Col-->
            <div class="col-6">
                <!--begin::Link-->
                <a href="{{ route('subjects.index') }}"
                    class="btn btn-icon btn-outline btn-bg-light btn-active-light-primary btn-flex flex-column flex-center w-100px h-100px border-gray-200"
                    data-kt-button="true">
                    <!--begin::Icon-->
                    <span class="mb-2">
                        <i class="ki-outline ki-book-open fs-1"></i> <!-- Ikon buku terbuka -->
                    </span>
                    <!--end::Icon-->
                    <!--begin::Label-->
                    <span class="fs-7 fw-bold">Subjects</span>
                    <!--end::Label-->
                </a>
                <!--end::Link-->
            </div>
            <!--end::Col-->
            <h3 class="text-gray-800 fw-bold mb-4">Konfigurasi</h3>

            <!--begin::Col-->
            <div class="col-6">
                <!--begin::Link-->
                <a href="{{ route('classrooms.settings') }}"
                    class="btn btn-icon btn-outline btn-bg-light btn-active-light-primary btn-flex flex-column flex-center w-100px h-100px border-gray-200"
                    data-kt-button="true">
                    <!--begin::Icon-->
                    <span class="mb-2">
                        <i class="ki-outline ki-gear fs-1"></i> <!-- Ikon gir -->
                    </span>
                    <!--end::Icon-->
                    <!--begin::Label-->
                    <span class="fs-7 fw-bold">Classroom Settings</span>
                    <!--end::Label-->
                </a>
                <!--end::Link-->
            </div>
            <!--end::Col-->

            <!--begin::Col-->
            <div class="col-6">
                <!--begin::Link-->
                <a href="{{ route('classrooms.overview') }}"
                    class="btn btn-icon btn-outline btn-bg-light btn-active-light-primary btn-flex flex-column flex-center w-100px h-100px border-gray-200"
                    data-kt-button="true">
                    <!--begin::Icon-->
                    <span class="mb-2">
                        <i class="ki-outline ki-eye fs-1"></i> <!-- Ikon mata -->
                    </span>
                    <!--end::Icon-->
                    <!--begin::Label-->
                    <span class="fs-7 fw-bold"> Overview <br>Class </span>
                    <!--end::Label-->
                </a>
                <!--end::Link-->
            </div>
        @endif


        {{-- ==================================GURU============================================================================================================= --}}
        @if ($userLevel === 'guru')
            <h3 class="text-gray-800 fw-bold mb-4">Konfigurasi</h3>

            <!--begin::Col-->
            <div class="col-6">
                <!--begin::Link-->
                <a href="{{ route('classrooms.settings') }}"
                    class="btn btn-icon btn-outline btn-bg-light btn-active-light-primary btn-flex flex-column flex-center w-100px h-100px border-gray-200"
                    data-kt-button="true">
                    <!--begin::Icon-->
                    <span class="mb-2">
                        <i class="ki-outline ki-gear fs-1"></i> <!-- Ikon gir -->
                    </span>
                    <!--end::Icon-->
                    <!--begin::Label-->
                    <span class="fs-7 fw-bold">Classroom Settings</span>
                    <!--end::Label-->
                </a>
                <!--end::Link-->
            </div>
            <!--end::Col-->

            <!--begin::Col-->
            <div class="col-6">
                <!--begin::Link-->
                <a href="{{ route('classrooms.overview') }}"
                    class="btn btn-icon btn-outline btn-bg-light btn-active-light-primary btn-flex flex-column flex-center w-100px h-100px border-gray-200"
                    data-kt-button="true">
                    <!--begin::Icon-->
                    <span class="mb-2">
                        <i class="ki-outline ki-eye fs-1"></i> <!-- Ikon mata -->
                    </span>
                    <!--end::Icon-->
                    <!--begin::Label-->
                    <span class="fs-7 fw-bold"> Overview <br>Class </span>
                    <!--end::Label-->
                </a>
                <!--end::Link-->
            </div>
        @endif
        <!--end::Col-->
        <form action="{{ route('teacher.logout') }}" method="POST" class="d-inline">
            @csrf
            <button type="submit"
                class="btn btn-icon btn-outline btn-bg-light btn-active-light-primary btn-flex flex-column flex-center w-100 h-50px border-gray-200 rounded-pill">
                <!--begin::Icon-->
                <span class="mb-2">
                    <i class="ki-outline ki-logout fs-1"></i> <!-- Ikon logout -->
                </span>
                <!--end::Icon-->
                <!--begin::Label-->
                <span class="fs-7 fw-bold">Logout</span>
                <!--end::Label-->
            </button>
        </form>
    </div>
    <!--end::Row-->

</div>
<!--end::Links-->
