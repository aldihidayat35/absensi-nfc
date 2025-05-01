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
                    <input type="text" data-kt-filter="search" class="form-control form-control-solid w-250px ps-14" placeholder="Search Classrooms" />
                </div>
                <!--end::Search-->
            </div>
            <div class="card-toolbar flex-row-fluid justify-content-end gap-5">
                <!--begin::Add Classroom Button-->
                <a href="{{ route('classrooms.create') }}" class="btn btn-primary">Add Classroom</a>
                <!--end::Add Classroom Button-->
            </div>
        </div>
        <div class="card-body p-4 ps-12">
            <table class="table align-middle rounded table-row-dashed ps-2 g-2" id="kt_datatable_example">
                <thead>
                    <tr class="text-start text-gray-500 fw-bold text-uppercase">
                        <th>ID</th>
                        <th>Name</th>
                        <th>Academic Year</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody class="fw-semibold text-gray-600">
                    @foreach ($classrooms as $classroom)
                        <tr>
                            <td>{{ $classroom->id }}</td>
                            <td>{{ $classroom->name }}</td>
                            <td>{{ $classroom->academic_year }}</td>
                            <td>
                                <a href="{{ route('classrooms.edit', $classroom->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                <form action="{{ route('classrooms.destroy', $classroom->id) }}" method="POST" style="display:inline;">
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