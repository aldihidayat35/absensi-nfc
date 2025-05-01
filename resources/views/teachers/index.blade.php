@extends('layouts.app')

@section('content')
<div id="kt_app_content" class="app-content flex-column-fluid">

    <div class="card card-p-2 card-flush">
        <div class="card-header align-items-center py-5 gap-2 gap-md-5">
            <div class="card-title">
                <!--begin::Search-->
                <div class="d-flex align-items-center position-relative my-1">
                    <span class="svg-icon fs-1 position-absolute ms-4">
                        <i class="ki-duotone ki-search"></i>
                    </span>
                    <input type="text" data-kt-filter="search" class="form-control form-control-solid w-250px ps-14" placeholder="Search Teachers" />
                </div>
                <!--end::Search-->
            </div>
            <div class="card-toolbar flex-row-fluid justify-content-end gap-5">
                <!--begin::Create Teacher Button-->
                <a href="{{ route('teachers.create') }}" class="btn btn-primary">
                    <i class="ki-duotone ki-plus fs-2"></i> Create Teacher
                </a>
                <!--end::Create Teacher Button-->
            </div>
        </div>
        <div class="card-body p-4">
            <table class="table align-middle rounded table-row-dashed ps-2 g-2" id="kt_datatable_example">
                <thead>
                    <tr class="text-start text-gray-500 fw-bold text-uppercase">
                        <th>NIP</th>
                        <th>Full Name</th>
                        <th>Position</th>
                        <th>Subject</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody class="fw-semibold text-gray-600">
                    @foreach ($teachers as $teacher)
                        <tr>
                            <td>{{ $teacher->nip }}</td>
                            <td>{{ $teacher->full_name }}</td>
                            <td>{{ $teacher->position }}</td>
                            <td>{{ $teacher->subject }}</td>
                            <td>{{ $teacher->status }}</td>
                            <td>
                                <a href="{{ route('teachers.show', $teacher->id) }}" class="btn btn-info btn-sm">Detail</a>
                                <a href="{{ route('teachers.edit', $teacher->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                <form action="{{ route('teachers.destroy', $teacher->id) }}" method="POST" style="display:inline;">
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
                handleSearchDatatable();
            }
        };
    }();

    KTUtil.onDOMContentLoaded(function () {
        KTDatatablesExample.init();
    });
</script>
@endsection