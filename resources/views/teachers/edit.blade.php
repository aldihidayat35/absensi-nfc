@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
      
        <div class="card-body">
            <form action="{{ route('teachers.update', $teacher->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row mb-3">
                    <label for="nip" class="col-md-3 col-form-label text-md-end">NIP</label>
                    <div class="col-md-9">
                        <input type="text" name="nip" class="form-control" value="{{ $teacher->nip }}" required>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="full_name" class="col-md-3 col-form-label text-md-end">Full Name</label>
                    <div class="col-md-9">
                        <input type="text" name="full_name" class="form-control" value="{{ $teacher->full_name }}" required>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="gender" class="col-md-3 col-form-label text-md-end">Gender</label>
                    <div class="col-md-9">
                        <div class="form-check form-check-inline">
                            <input type="radio" name="gender" value="Male" class="form-check-input" {{ $teacher->gender == 'Male' ? 'checked' : '' }} required>
                            <label class="form-check-label">Male</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input type="radio" name="gender" value="Female" class="form-check-input" {{ $teacher->gender == 'Female' ? 'checked' : '' }} required>
                            <label class="form-check-label">Female</label>
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="birth_place" class="col-md-3 col-form-label text-md-end">Birth Place</label>
                    <div class="col-md-9">
                        <input type="text" name="birth_place" class="form-control" value="{{ $teacher->birth_place }}" required>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="birth_date" class="col-md-3 col-form-label text-md-end">Birth Date</label>
                    <div class="col-md-9">
                        <input type="date" name="birth_date" class="form-control" value="{{ $teacher->birth_date }}" required>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="religion" class="col-md-3 col-form-label text-md-end">Religion</label>
                    <div class="col-md-9">
                        <input type="text" name="religion" class="form-control" value="{{ $teacher->religion }}" required>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="phone" class="col-md-3 col-form-label text-md-end">Phone</label>
                    <div class="col-md-9">
                        <input type="text" name="phone" class="form-control" value="{{ $teacher->phone }}" required>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="email" class="col-md-3 col-form-label text-md-end">Email</label>
                    <div class="col-md-9">
                        <input type="email" name="email" class="form-control" value="{{ $teacher->email }}" required>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="address" class="col-md-3 col-form-label text-md-end">Address</label>
                    <div class="col-md-9">
                        <textarea name="address" class="form-control" required>{{ $teacher->address }}</textarea>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="status" class="col-md-3 col-form-label text-md-end">Status</label>
                    <div class="col-md-9">
                        <select name="status" class="form-control" required>
                            <option value="aktif" {{ $teacher->status == 'aktif' ? 'selected' : '' }}>Aktif</option>
                            <option value="tidak aktif" {{ $teacher->status == 'tidak aktif' ? 'selected' : '' }}>Tidak Aktif</option>
                        </select>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="position" class="col-md-3 col-form-label text-md-end">Position</label>
                    <div class="col-md-9">
                        <input type="text" name="position" class="form-control" value="{{ $teacher->position }}" required>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="subject" class="col-md-3 col-form-label text-md-end">Subject</label>
                    <div class="col-md-9">
                        <input type="text" name="subject" class="form-control" value="{{ $teacher->subject }}" required>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="photo" class="col-md-3 col-form-label text-md-end">Photo</label>
                    <div class="col-md-9">
                        <input type="file" name="photo" class="form-control">
                        @if ($teacher->photo)
                            <img src="{{ asset($teacher->photo) }}" alt="Teacher Photo" class="img-thumbnail mt-2" width="150">
                        @endif
                    </div>
                </div>
                <div class="row mb-0">
                    <div class="col-md-9 offset-md-3">
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection