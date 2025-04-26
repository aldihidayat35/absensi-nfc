@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Add Classroom</h1>
    <form action="{{ route('classrooms.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" name="name" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="academic_year" class="form-label">Academic Year</label>
            <input type="text" name="academic_year" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Save</button>
    </form>
</div>
@endsection