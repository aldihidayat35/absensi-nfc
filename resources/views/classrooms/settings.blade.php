@extends('layouts.app')

@section('content')
<div class="container">

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <!-- Combobox untuk memilih kelas -->
    <div class="card mb-5">
        <div class="card-body">
            <form action="{{ route('classrooms.settings') }}" method="GET">
                <div class="row">
                    <div class="col-md-6">
                        <label for="classroom_filter" class="form-label fw-bold">Select Classroom</label>
                        <select name="classroom_id" id="classroom_filter" class="form-select" onchange="this.form.submit()">
                            <option value="">-- All Students --</option>
                            <option value="no_class" {{ request('classroom_id') == 'no_class' ? 'selected' : '' }}>Without Class</option>
                            @foreach ($classrooms as $classroom)
                                @if ($classroom->students->count() > 0) <!-- Filter classrooms with students -->
                                    <option value="{{ $classroom->id }}" {{ request('classroom_id') == $classroom->id ? 'selected' : '' }}>
                                        {{ $classroom->name }} ({{ $classroom->academic_year }})
                                    </option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Tabel siswa -->
    <div class="card mb-5">
      
        <div class="card-body">
            <form action="{{ route('classrooms.settings.update') }}" method="POST">
                @csrf
                <div class="table-responsive">
                    <table class="table align-middle rounded table-row-dashed ps-2 g-2" id="{{ $students->isEmpty() ? '' : 'kt_datatable_students' }}">
                        <thead class="text-gray-500 fw-bold text-uppercase">
                            <tr>
                                <th>
                                    <input type="checkbox" id="select_all" class="form-check-input" />
                                </th>
                                <th>Name</th>
                                <th>NIS</th>
                                <th>Current Classroom</th>
                            </tr>
                        </thead>
                        <tbody class="fw-semibold text-gray-600">
                            @forelse ($students as $student)
                                <tr>
                                    <td>
                                        <input type="checkbox" name="student_ids[]" value="{{ $student->id }}" class="form-check-input student-checkbox">
                                    </td>
                                    <td>{{ $student->full_name }}</td>
                                    <td>{{ $student->nis }}</td>
                                    <td>
                                        {{ $student->classroom ? $student->classroom->name . ' (' . $student->classroom->academic_year . ')' : 'Without Class' }}
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center">No students found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="mt-4">
                    <label for="classroom_id" class="form-label fw-bold">Select Classroom</label>
                    <select name="classroom_id" id="classroom_id" class="form-select mb-3" required>
                        <option value="">-- Select Classroom --</option>
                        @foreach ($classrooms as $classroom)
                            <option value="{{ $classroom->id }}">{{ $classroom->name }} ({{ $classroom->academic_year }})</option>
                        @endforeach
                    </select>
                    <button type="submit" class="btn btn-primary">Move Students</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Classrooms Overview -->
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Classrooms Overview</h3>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table align-middle rounded table-row-dashed ps-2 g-2" id="kt_datatable_classrooms">
                    <thead class="text-gray-500 fw-bold text-uppercase">    
                        <tr>
                            <th>Classroom</th>
                            <th>Academic Year</th>
                            <th>Students</th>
                        </tr>
                    </thead>
                    <tbody class="fw-semibold text-gray-600">
                        @foreach ($classrooms as $classroom)
                            <tr>
                                <td>{{ $classroom->name }}</td>
                                <td>{{ $classroom->academic_year }}</td>
                                <td>
                                    <button class="btn btn-link p-0" type="button" data-bs-toggle="collapse" data-bs-target="#students-{{ $classroom->id }}" aria-expanded="false" aria-controls="students-{{ $classroom->id }}">
                                        View Details
                                    </button>
                                    <div class="collapse mt-2" id="students-{{ $classroom->id }}">
                                        <ul class="list-group">
                                            @forelse ($classroom->students as $student)
                                                <li class="list-group-item">{{ $student->full_name }} ({{ $student->nis }})</li>
                                            @empty
                                                <li class="list-group-item">No students in this classroom.</li>
                                            @endforelse
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    "use strict";

    $(document).ready(function () {
        // Periksa apakah tabel memiliki ID 'kt_datatable_students'
        const tableElement = $('#kt_datatable_students');
        if (tableElement.length) {
            // Initialize DataTable for Students
            const table = tableElement.DataTable({
                "info": false,
                "autoWidth": false,
                'order': [],
                'pageLength': 10,
                dom: "<'row'<'col-sm-12 col-md-6'l><'col-sm-12 col-md-6'f>>" +
                     "<'row'<'col-sm-12'tr>>" +
                     "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>" +
                     "<'row'<'col-sm-12 col-md-12'B>>",
                buttons: [
                    {
                        extend: 'copyHtml5',
                        text: '<i class="fa fa-copy"></i> Copy',
                        className: 'btn btn-light-primary btn-sm'
                    },
                    {
                        extend: 'csvHtml5',
                        text: '<i class="fa fa-file-csv"></i> CSV',
                        className: 'btn btn-light-primary btn-sm'
                    },
                    {
                        extend: 'excelHtml5',
                        text: '<i class="fa fa-file-excel"></i> Excel',
                        className: 'btn btn-light-primary btn-sm'
                    },
                    {
                        extend: 'pdfHtml5',
                        text: '<i class="fa fa-file-pdf"></i> PDF',
                        className: 'btn btn-light-primary btn-sm'
                    },
                    {
                        extend: 'print',
                        text: '<i class="fa fa-print"></i> Print',
                        className: 'btn btn-light-primary btn-sm'
                    }
                ],
            });

            // Select All functionality
            $('#select_all').on('click', function () {
                const isChecked = $(this).is(':checked');
                $('.student-checkbox').prop('checked', isChecked);
            });

            // Uncheck "Select All" if any checkbox is unchecked
            tableElement.on('change', '.student-checkbox', function () {
                if (!$(this).is(':checked')) {
                    $('#select_all').prop('checked', false);
                }
            });

            // Check "Select All" if all checkboxes are checked
            tableElement.on('change', '.student-checkbox', function () {
                if ($('.student-checkbox:checked').length === $('.student-checkbox').length) {
                    $('#select_all').prop('checked', true);
                }
            });
        }
    });
</script>
@endsection