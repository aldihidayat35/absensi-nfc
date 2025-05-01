@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Add Teacher</h3>
        </div>
        <div class="card-body">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form action="{{ route('teachers.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="nip" class="form-label fw-bold">NIP</label>
                        <input type="text" name="nip" class="form-control form-control-solid" value="{{ old('nip') }}" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="full_name" class="form-label fw-bold">Full Name</label>
                        <input type="text" name="full_name" class="form-control form-control-solid" value="{{ old('full_name') }}" required>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="password" class="form-label fw-bold">Password</label>
                        <input type="password" name="password" class="form-control form-control-solid" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="level" class="form-label fw-bold">Level</label>
                        <select name="level" class="form-select form-select-solid" required>
                            <option value="admin" {{ old('level') == 'admin' ? 'selected' : '' }}>Admin</option>
                            <option value="waka" {{ old('level') == 'waka' ? 'selected' : '' }}>Waka</option>
                            <option value="guru" {{ old('level') == 'guru' ? 'selected' : '' }}>Guru</option>
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="gender" class="form-label fw-bold">Gender</label>
                        <div class="d-flex align-items-center">
                            <div class="form-check me-3">
                                <input type="radio" name="gender" value="Male" class="form-check-input" {{ old('gender') == 'Male' ? 'checked' : '' }} required>
                                <label class="form-check-label">Male</label>
                            </div>
                            <div class="form-check">
                                <input type="radio" name="gender" value="Female" class="form-check-input" {{ old('gender') == 'Female' ? 'checked' : '' }} required>
                                <label class="form-check-label">Female</label>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="birth_place" class="form-label fw-bold">Birth Place</label>
                        <input type="text" name="birth_place" class="form-control form-control-solid" value="{{ old('birth_place') }}" required>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="birth_date" class="form-label fw-bold">Birth Date</label>
                        <input type="date" name="birth_date" class="form-control form-control-solid" value="{{ old('birth_date') }}" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="religion" class="form-label fw-bold">Religion</label>
                        <select name="religion" class="form-select form-select-solid" required>
                            <option value="Islam" {{ old('religion') == 'Islam' ? 'selected' : '' }}>Islam</option>
                            <option value="Christian" {{ old('religion') == 'Christian' ? 'selected' : '' }}>Christian</option>
                            <option value="Hindu" {{ old('religion') == 'Hindu' ? 'selected' : '' }}>Hindu</option>
                            <option value="Buddhist" {{ old('religion') == 'Buddhist' ? 'selected' : '' }}>Buddhist</option>
                            <option value="Other" {{ old('religion') == 'Other' ? 'selected' : '' }}>Other</option>
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="phone" class="form-label fw-bold">Phone</label>
                        <input type="text" name="phone" class="form-control form-control-solid" value="{{ old('phone') }}" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="email" class="form-label fw-bold">Email</label>
                        <input type="email" name="email" class="form-control form-control-solid" value="{{ old('email') }}" required>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="address" class="form-label fw-bold">Address</label>
                    <textarea name="address" class="form-control form-control-solid" rows="3" required>{{ old('address') }}</textarea>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="status" class="form-label fw-bold">Status</label>
                        <select name="status" class="form-select form-select-solid" required>
                            <option value="aktif" {{ old('status') == 'aktif' ? 'selected' : '' }}>Aktif</option>
                            <option value="tidak aktif" {{ old('status') == 'tidak aktif' ? 'selected' : '' }}>Tidak Aktif</option>
                        </select>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="position" class="form-label fw-bold">Position</label>
                        <input type="text" name="position" class="form-control form-control-solid" value="{{ old('position') }}" required>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="subject" class="form-label fw-bold">Subject</label>
                        <input type="text" name="subject" class="form-control form-control-solid" value="{{ old('subject') }}" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="photo" class="form-label fw-bold">Photo</label>
                        <input type="file" name="photo" class="form-control form-control-solid">
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Save</button>
            </form>
        </div>
    </div>
</div>
@endsection