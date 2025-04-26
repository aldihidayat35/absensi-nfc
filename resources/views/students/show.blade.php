@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Student Profile</h1>
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                        @if ($student->photo)
                            <img src="{{ asset($student->photo) }}" alt="Student Photo" class="img-thumbnail" width="200">
                        @else
                            <img src="https://via.placeholder.com/200" alt="No Photo" class="img-thumbnail">
                        @endif
                    </div>
                    <div class="col-md-8">
                        <table class="table table-bordered">
                            <tr>
                                <th>NIS</th>
                                <td>{{ $student->nis }}</td>
                            </tr>
                            <tr>
                                <th>Full Name</th>
                                <td>{{ $student->full_name }}</td>
                            </tr>
                            <tr>
                                <th>Birth Place</th>
                                <td>{{ $student->birth_place }}</td>
                            </tr>
                            <tr>
                                <th>Birth Date</th>
                                <td>{{ $student->birth_date }}</td>
                            </tr>
                            <tr>
                                <th>Gender</th>
                                <td>{{ $student->gender }}</td>
                            </tr>
                            <tr>
                                <th>Religion</th>
                                <td>{{ $student->religion }}</td>
                            </tr>
                            <tr>
                                <th>Address</th>
                                <td>{{ $student->address }}</td>
                            </tr>
                            <tr>
                                <th>Phone</th>
                                <td>{{ $student->phone }}</td>
                            </tr>
                            <tr>
                                <th>Email</th>
                                <td>{{ $student->email }}</td>
                            </tr>
                            <tr>
                                <th>Nationality</th>
                                <td>{{ $student->nationality }}</td>
                            </tr>
                            <tr>
                                <th>Classroom</th>
                                <td>
                                    {{ $student->classroom ? $student->classroom->name . ' (' . $student->classroom->academic_year . ')' : 'No Classroom' }}
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
                <a href="{{ route('students.index') }}" class="btn btn-secondary mt-3">Back to Students</a>
            </div>
        </div>
    </div>
@endsection
