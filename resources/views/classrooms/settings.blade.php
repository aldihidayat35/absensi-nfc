@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-5">Classroom Settings</h1>

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
                                <option value="{{ $classroom->id }}" {{ request('classroom_id') == $classroom->id ? 'selected' : '' }}>
                                    {{ $classroom->name }} ({{ $classroom->academic_year }})
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Tabel siswa -->
    <div class="card mb-5">
        <div class="card-header">
            <h3 class="card-title">Students</h3>
        </div>
        <div class="card-body">
            <form action="{{ route('classrooms.settings.update') }}" method="POST">
                @csrf
                <div class="table-responsive">
                    <table class="table table-bordered table-striped align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>Select</th>
                                <th>Name</th>
                                <th>NIS</th>
                                <th>Current Classroom</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($students as $student)
                                <tr>
                                    <td>
                                        <input type="checkbox" name="student_ids[]" value="{{ $student->id }}" class="form-check-input">
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
                <table class="table table-bordered table-striped align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>Classroom</th>
                            <th>Academic Year</th>
                            <th>Students</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($classrooms as $classroom)
                            <tr>
                                <td>{{ $classroom->name }}</td>
                                <td>{{ $classroom->academic_year }}</td>
                                <td>
                                    <button class="btn btn-link p-0" type="button" data-bs-toggle="collapse" data-bs-target="#students-{{ $classroom->id }}" aria-expanded="false" aria-controls="students-{{ $classroom->id }}">
                                        Lihat Selengkapnya
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