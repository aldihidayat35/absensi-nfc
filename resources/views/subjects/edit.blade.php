{{-- filepath: resources/views/subjects/create.blade.php --}}
{{-- filepath: resources/views/subjects/edit.blade.php --}}
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">{{ isset($subject) ? 'Edit Subject' : 'Add Subject' }}</h3>
        </div>
        <div class="card-body">
            <form action="{{ isset($subject) ? route('subjects.update', $subject->id) : route('subjects.store') }}" method="POST">
                @csrf
                @if(isset($subject))
                    @method('PUT')
                @endif
                <div class="mb-3">
                    <label for="name" class="form-label fw-bold">Name</label>
                    <input type="text" name="name" class="form-control form-control-solid" value="{{ $subject->name ?? '' }}" required>
                </div>
                <div class="mb-3">
                    <label for="code" class="form-label fw-bold">Code</label>
                    <input type="text" name="code" class="form-control form-control-solid" value="{{ $subject->code ?? '' }}">
                </div>
                <div class="mb-3">
                    <label for="group" class="form-label fw-bold">Group</label>
                    <select name="group" class="form-select form-select-solid" required>
                        <option value="Wajib" {{ (isset($subject) && $subject->group == 'Wajib') ? 'selected' : '' }}>Wajib</option>
                        <option value="Peminatan" {{ (isset($subject) && $subject->group == 'Peminatan') ? 'selected' : '' }}>Peminatan</option>
                        <option value="Umum" {{ (isset($subject) && $subject->group == 'Umum') ? 'selected' : '' }}>Umum</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="description" class="form-label fw-bold">Description</label>
                    <textarea name="description" class="form-control form-control-solid" rows="3">{{ $subject->description ?? '' }}</textarea>
                </div>
                <button type="submit" class="btn btn-primary">{{ isset($subject) ? 'Update' : 'Save' }}</button>
            </form>
        </div>
    </div>
</div>
@endsection