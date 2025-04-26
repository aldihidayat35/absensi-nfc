@extends('layouts.app')

@section('content')
  <h1 class="text-xl font-bold mb-4">{{ isset($student) ? 'Edit' : 'Tambah' }} Siswa</h1>

  <form action="{{ isset($student) ? route('students.update', $student) : route('students.store') }}" method="POST">
    @csrf
    @if(isset($student))
      @method('PUT')
    @endif

    <div class="mb-4">
      <label class="block">NIS</label>
      <input type="text" name="nis" class="w-full border rounded px-3 py-2"
             value="{{ old('nis', $student->nis ?? '') }}">
    </div>

    <div class="mb-4">
      <label class="block">Nama</label>
      <input type="text" name="name" class="w-full border rounded px-3 py-2"
             value="{{ old('name', $student->name ?? '') }}">
    </div>

    <div class="mb-4">
      <label class="block">UID NFC</label>
      <input type="text" name="nfc_uid" class="w-full border rounded px-3 py-2"
             value="{{ old('nfc_uid', $student->nfc_uid ?? '') }}">
    </div>

    <div class="mb-4">
      <label class="block">No. WA Orang Tua</label>
      <input type="text" name="parent_phone" class="w-full border rounded px-3 py-2"
             value="{{ old('parent_phone', $student->parent_phone ?? '') }}">
    </div>

    <div class="mb-4">
      <label class="block">Kelas</label>
      <select name="classroom_id" class="w-full border rounded px-3 py-2">
        @foreach($classrooms as $class)
          <option value="{{ $class->id }}" {{ (old('classroom_id') == $class->id) ? 'selected' : '' }}>
            {{ $class->name }}
          </option>
        @endforeach
      </select>
    </div>

    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">
      Simpan
    </button>
  </form>
@endsection
