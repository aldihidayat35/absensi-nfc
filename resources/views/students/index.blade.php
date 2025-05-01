@extends('layouts.app')

@section('content')
<div id="kt_app_content" class="app-content  flex-column-fluid " >

    <div class="card card-p-2 card-flush ">
        <div class="card-header align-items-center py-5 gap-2 gap-md-5">
            <div class="card-title">
                <!--begin::Search-->
                <div class="d-flex align-items-center position-relative my-1">
                    <span class="svg-icon fs-1 position-absolute ms-4">
                        <i class="ki-duotone ki-search"></i>
                    </span>
                    <input type="text" data-kt-filter="search" class="form-control form-control-solid w-250px ps-14" placeholder="Search Students" />
                </div>
                <!--end::Search-->
            </div>
            <div class="card-toolbar flex-row-fluid justify-content-end gap-5">
                <!--begin::Create Student Button-->
                <a href="{{ route('students.create') }}" class="btn btn-primary">
                    <i class="ki-duotone ki-plus fs-2"></i> Create Student
                </a>
                <!--end::Create Student Button-->

                <!--begin::Export dropdown-->
                <button type="button" class="btn btn-light-primary" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                    <i class="ki-duotone ki-exit-down fs-2"></i> Export
                </button>
                <!--begin::Menu-->
                <div id="kt_datatable_example_export_menu" class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-200px py-4" data-kt-menu="true">
                    <div class="menu-item px-3">
                        <a href="#" class="menu-link px-3" data-kt-export="copy">Copy to clipboard</a>
                    </div>
                    <div class="menu-item px-3">
                        <a href="#" class="menu-link px-3" data-kt-export="excel">Export as Excel</a>
                    </div>
                    <div class="menu-item px-3">
                        <a href="#" class="menu-link px-3" data-kt-export="csv">Export as CSV</a>
                    </div>
                    <div class="menu-item px-3">
                        <a href="#" class="menu-link px-3" data-kt-export="pdf">Export as PDF</a>
                    </div>
                </div>
                <!--end::Menu-->
            </div>
        </div>
        <div class="card-body p-4 ps-12">
            <table class="table align-middle  rounded table-row-dashed  ps-2 g-2" id="kt_datatable_example">
                <thead>
                    <tr class="text-start text-gray-500 fw-bold  text-uppercase">
                        {{-- <th>ID</th> --}}
                        <th>NIS</th>
                        <th>Name</th>
                        <th>NFC UID</th>
                        <th>Parent Phone</th>
                        <th>Classroom</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody class="fw-semibold text-gray-600">
                    @foreach ($students as $student)
                        <tr>
                            {{-- <td>{{ $student->id }}</td> --}}
                            <td>{{ $student->nis }}</td>
                            <td>{{ $student->full_name }}</td>
                            <td>{{ $student->nfc_uid }}</td>
                            <td>{{ $student->parent_phone }}</td>
                            <td>
                                {{ $student->classroom ? $student->classroom->name . ' (' . $student->classroom->academic_year . ')' : 'No Classroom' }}
                            </td>
                            <td>{{ $student->status }}</td>
                            <td>
                                <a href="{{ route('students.show', $student->id) }}" class="btn btn-info btn-sm">Detail</a>
                                <a href="{{ route('students.edit', $student->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                <form action="{{ route('students.destroy', $student->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    "use strict";

    var KTDatatablesExample = function () {
        var table;
        var datatable;

        var initDatatable = function () {
            datatable = $('#kt_datatable_example').DataTable({
                "info": false,
                'order': [],
                'pageLength': 10,
            });
        }

        var exportButtons = () => {
            const documentTitle = 'Students Report';
            var buttons = new $.fn.dataTable.Buttons(table, {
                buttons: [
                    {
                        extend: 'copyHtml5',
                        title: documentTitle
                    },
                    {
                        extend: 'excelHtml5',
                        title: documentTitle
                    },
                    {
                        extend: 'csvHtml5',
                        title: documentTitle
                    },
                    {
                        extend: 'pdfHtml5',
                        title: documentTitle
                    }
                ]
            }).container().appendTo($('#kt_datatable_example_buttons'));

            const exportButtons = document.querySelectorAll('#kt_datatable_example_export_menu [data-kt-export]');
            exportButtons.forEach(exportButton => {
                exportButton.addEventListener('click', e => {
                    e.preventDefault();
                    const exportValue = e.target.getAttribute('data-kt-export');
                    const target = document.querySelector('.dt-buttons .buttons-' + exportValue);
                    target.click();
                });
            });
        }

        var handleSearchDatatable = () => {
            const filterSearch = document.querySelector('[data-kt-filter="search"]');
            filterSearch.addEventListener('keyup', function (e) {
                datatable.search(e.target.value).draw();
            });
        }

        return {
            init: function () {
                table = document.querySelector('#kt_datatable_example');
                if (!table) return;
                initDatatable();
                exportButtons();
                handleSearchDatatable();
            }
        };
    }();

    KTUtil.onDOMContentLoaded(function () {
        KTDatatablesExample.init();
    });
</script>
@endsection
