@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Classroom: {{ $classroom->name }}</h1>
    <p>Academic Year: {{ $classroom->academic_year }}</p>
    <h3>Students</h3>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>NIS</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($classroom->students as $student)
                <tr>
                    <td>{{ $student->id }}</td>
                    <td>{{ $student->name }}</td>
                    <td>{{ $student->nis }}</td>
                    <td>{{ $student->status }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <a href="{{ route('classrooms.index') }}" class="btn btn-secondary">Back to Classrooms</a>
</div>
@endsection