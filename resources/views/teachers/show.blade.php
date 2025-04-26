@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Teacher Profile</h1>
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-4">
                    @if ($teacher->photo)
                        <img src="{{ asset($teacher->photo) }}" alt="Teacher Photo" class="img-thumbnail" width="200">
                    @else
                        <img src="https://via.placeholder.com/200" alt="No Photo" class="img-thumbnail">
                    @endif
                </div>
                <div class="col-md-8">
                    <table class="table table-bordered">
                        <tr>
                            <th>NIP</th>
                            <td>{{ $teacher->nip }}</td>
                        </tr>
                        <tr>
                            <th>Full Name</th>
                            <td>{{ $teacher->full_name }}</td>
                        </tr>
                        <tr>
                            <th>Gender</th>
                            <td>{{ $teacher->gender }}</td>
                        </tr>
                        <tr>
                            <th>Birth Place</th>
                            <td>{{ $teacher->birth_place }}</td>
                        </tr>
                        <tr>
                            <th>Birth Date</th>
                            <td>{{ $teacher->birth_date }}</td>
                        </tr>
                        <tr>
                            <th>Religion</th>
                            <td>{{ $teacher->religion }}</td>
                        </tr>
                        <tr>
                            <th>Phone</th>
                            <td>{{ $teacher->phone }}</td>
                        </tr>
                        <tr>
                            <th>Email</th>
                            <td>{{ $teacher->email }}</td>
                        </tr>
                        <tr>
                            <th>Address</th>
                            <td>{{ $teacher->address }}</td>
                        </tr>
                        <tr>
                            <th>Status</th>
                            <td>{{ $teacher->status }}</td>
                        </tr>
                        <tr>
                            <th>Position</th>
                            <td>{{ $teacher->position }}</td>
                        </tr>
                        <tr>
                            <th>Subject</th>
                            <td>{{ $teacher->subject }}</td>
                        </tr>
                    </table>
                </div>
            </div>
            <a href="{{ route('teachers.index') }}" class="btn btn-secondary mt-3">Back to Teachers</a>
        </div>
    </div>
</div>
@endsection