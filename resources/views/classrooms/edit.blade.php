@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">{{ isset($classroom) ? 'Edit Classroom' : 'Create Classroom' }}</h3>
        </div>
        <div class="card-body">
            <form action="{{ isset($classroom) ? route('classrooms.update', $classroom->id) : route('classrooms.store') }}" method="POST">
                @csrf
                @if(isset($classroom))
                    @method('PUT')
                @endif
                <div class="mb-3">
                    <label for="name" class="form-label fw-bold">Name</label>
                    <input type="text" name="name" class="form-control form-control-solid" value="{{ $classroom->name ?? '' }}" required>
                </div>
                <div class="mb-3">
                    <label for="academic_year" class="form-label fw-bold">Academic Year</label>
                    <input type="text" name="academic_year" class="form-control form-control-solid" value="{{ $classroom->academic_year ?? '' }}" required>
                </div>
                <button type="submit" class="btn btn-primary">{{ isset($classroom) ? 'Update' : 'Create' }}</button>
            </form>
        </div>
    </div>
</div>
@endsection