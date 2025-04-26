@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Student</h1>
    <form action="{{ route('students.update', $student->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="nis" class="form-label">NIS</label>
            <input type="text" name="nis" class="form-control" value="{{ $student->nis }}" required>
        </div>
        <div class="mb-3">
            <label for="full_name" class="form-label">Full Name</label>
            <input type="text" name="full_name" class="form-control" value="{{ $student->full_name }}" required>
        </div>
        <div class="mb-3">
            <label for="birth_place" class="form-label">Birth Place</label>
            <input type="text" name="birth_place" class="form-control" value="{{ $student->birth_place }}" required>
        </div>
        <div class="mb-3">
            <label for="birth_date" class="form-label">Birth Date</label>
            <input type="date" name="birth_date" class="form-control" value="{{ $student->birth_date }}" required>
        </div>
        <div class="mb-3">
            <label for="gender" class="form-label">Gender</label><br>
            <input type="radio" name="gender" value="Male" {{ $student->gender == 'Male' ? 'checked' : '' }} required> Male
            <input type="radio" name="gender" value="Female" {{ $student->gender == 'Female' ? 'checked' : '' }} required> Female
        </div>
        <div class="mb-3">
            <label for="religion" class="form-label">Religion</label>
            <select name="religion" class="form-control" required>
                <option value="Islam" {{ $student->religion == 'Islam' ? 'selected' : '' }}>Islam</option>
                <option value="Christian" {{ $student->religion == 'Christian' ? 'selected' : '' }}>Christian</option>
                <option value="Hindu" {{ $student->religion == 'Hindu' ? 'selected' : '' }}>Hindu</option>
                <option value="Buddhist" {{ $student->religion == 'Buddhist' ? 'selected' : '' }}>Buddhist</option>
                <option value="Other" {{ $student->religion == 'Other' ? 'selected' : '' }}>Other</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="address" class="form-label">Address</label>
            <textarea name="address" class="form-control" required>{{ $student->address }}</textarea>
        </div>
        <div class="mb-3">
            <label for="phone" class="form-label">Phone</label>
            <input type="text" name="phone" class="form-control" value="{{ $student->phone }}" required>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" name="email" class="form-control" value="{{ $student->email }}">
        </div>
        <div class="mb-3">
            <label for="nationality" class="form-label">Nationality</label>
            <select name="nationality" class="form-control" required>
                <option value="Indonesian" {{ $student->nationality == 'Indonesian' ? 'selected' : '' }}>Indonesian</option>
                <option value="Other" {{ $student->nationality == 'Other' ? 'selected' : '' }}>Other</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="photo" class="form-label">Photo</label>
            <input type="file" name="photo" class="form-control">
            @if ($student->photo)
                <img src="{{ asset('storage/' . $student->photo) }}" alt="Student Photo" class="img-thumbnail mt-2" width="150">
            @endif
        </div>
        <div class="mb-3">
            <label for="nfc_uid" class="form-label">NFC UID</label>
            <input type="text" name="nfc_uid" class="form-control" value="{{ $student->nfc_uid }}">
        </div>
        <div class="mb-3">
            <label for="parent_phone" class="form-label">Parent Phone</label>
            <input type="text" name="parent_phone" class="form-control" value="{{ $student->parent_phone }}">
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>
@endsection