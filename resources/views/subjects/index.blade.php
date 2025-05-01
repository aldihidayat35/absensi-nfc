{{-- filepath: resources/views/subjects/index.blade.php --}}
@extends('layouts.app')

@section('content')
<div class="container-xxl">
    <!--begin::Card-->
    <div class="card card-flush">
        <!--begin::Card header-->
        <div class="card-header pt-5">
            <h3 class="card-title align-items-start flex-column">
                <span class="card-label fw-bold fs-3 mb-1">Subjects</span>
         
            </h3>
            <div class="card-toolbar">
                <a href="{{ route('subjects.create') }}" class="btn btn-primary">Add Subject</a>
            </div>
        </div>
        <!--end::Card header-->
        <!--begin::Card body-->
        <div class="card-body pt-0">
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            <table class="table align-middle table-row-dashed fs-6 gy-5">
                <thead>
                    <tr class="text-start text-muted fw-bold fs-7 text-uppercase gs-0">
                        <th>#</th>
                        <th>Name</th>
                        <th>Code</th>
                        <th>Group</th>
                        <th>Description</th>
                        <th class="text-end">Actions</th>
                    </tr>
                </thead>
                <tbody class="text-gray-600 fw-semibold">
                    @foreach($subjects as $subject)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $subject->name }}</td>
                            <td>{{ $subject->code }}</td>
                            <td>{{ $subject->group }}</td>
                            <td>{{ $subject->description }}</td>
                            <td class="text-end">
                                <a href="{{ route('subjects.edit', $subject->id) }}" class="btn btn-icon btn-warning btn-sm">
                                    <i class="ki-outline ki-pencil"></i>
                                </a>
                                <form action="{{ route('subjects.destroy', $subject->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-icon btn-danger btn-sm" onclick="return confirm('Are you sure?')">
                                        <i class="ki-outline ki-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <!--end::Card body-->
    </div>
    <!--end::Card-->
</div>
@endsection