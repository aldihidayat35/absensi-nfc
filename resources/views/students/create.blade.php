@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Add Student</h3>
        </div>
        <div class="card-body">
            <form action="{{ route('students.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="nis" class="form-label fw-bold">NIS</label>
                        <input type="text" name="nis" class="form-control form-control-solid" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="full_name" class="form-label fw-bold">Full Name</label>
                        <input type="text" name="full_name" class="form-control form-control-solid" required>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="birth_place" class="form-label fw-bold">Birth Place</label>
                        <input type="text" name="birth_place" class="form-control form-control-solid" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="birth_date" class="form-label fw-bold">Birth Date</label>
                        <input type="date" name="birth_date" class="form-control form-control-solid" required>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="gender" class="form-label fw-bold">Gender</label>
                        <div class="d-flex align-items-center">
                            <div class="form-check me-3">
                                <input type="radio" name="gender" value="Male" class="form-check-input" required>
                                <label class="form-check-label">Male</label>
                            </div>
                            <div class="form-check">
                                <input type="radio" name="gender" value="Female" class="form-check-input" required>
                                <label class="form-check-label">Female</label>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="religion" class="form-label fw-bold">Religion</label>
                        <select name="religion" class="form-select form-select-solid" required>
                            <option value="Islam">Islam</option>
                            <option value="Christian">Christian</option>
                            <option value="Hindu">Hindu</option>
                            <option value="Buddhist">Buddhist</option>
                            <option value="Other">Other</option>
                        </select>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="address" class="form-label fw-bold">Address</label>
                    <textarea name="address" class="form-control form-control-solid" rows="3" required></textarea>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="phone" class="form-label fw-bold">Phone</label>
                        <input type="text" name="phone" class="form-control form-control-solid" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="email" class="form-label fw-bold">Email</label>
                        <input type="email" name="email" class="form-control form-control-solid">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="nationality" class="form-label fw-bold">Nationality</label>
                        <select name="nationality" class="form-select form-select-solid" required>
                            <option value="Indonesian">Indonesian</option>
                            <option value="Other">Other</option>
                        </select>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="photo" class="form-label fw-bold">Photo</label>
                        <input type="file" name="photo" class="form-control form-control-solid">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="nfc_uid" class="form-label fw-bold">NFC UID</label>
                        <input type="text" name="nfc_uid" class="form-control form-control-solid">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="parent_phone" class="form-label fw-bold">Parent Phone</label>
                        <input type="text" name="parent_phone" class="form-control form-control-solid">
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Save</button>
            </form>
        </div>
    </div>
</div>
@endsection