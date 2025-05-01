{{-- filepath: resources/views/classrooms/overview.blade.php --}}
@extends('layouts.app')

@section('content')
<div class="card container p-4">
    @foreach ($classrooms as $classroom)
        <div class="card mb-5">
            <div class="card-header hover-primary" data-bs-toggle="collapse" href="#collapse-{{ $classroom->id }}" role="button" aria-expanded="false" aria-controls="collapse-{{ $classroom->id }}" style="cursor: pointer; border: 2px solid transparent;" onmouseover="this.style.borderColor='#007bff';" onmouseout="this.style.borderColor='transparent';">
                <h3 class="card-title text-gray-900">
                    {{ $classroom->name }} ({{ $classroom->academic_year }})
                </h3>
            </div>

            <div class="collapse" id="collapse-{{ $classroom->id }}">

                <div class="card-body ">
                    <div class="table-responsive">
                        @if ($classroom->students->isNotEmpty())
                            <table class="table align-middle table-row-dashed fs-6 gy-5 datatable" id="datatable-{{ $classroom->id }}">
                                <thead class="text-gray-500 fw-bold text-uppercase">
                                    <tr>
                                        <th class="min-w-50px">#</th>
                                        <th class="min-w-150px">Name</th>
                                        <th class="min-w-100px">NIS</th>
                                        <th class="min-w-100px">Gender</th>
                                        <th class="min-w-150px">Parent Phone</th>
                                    </tr>
                                </thead>
                                <tbody class="text-gray-600 fw-semibold">
                                    @forelse ($classroom->students->sortBy('full_name') as $student)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $student->full_name }}</td>
                                            <td>{{ $student->nis }}</td>
                                            <td>{{ $student->gender }}</td>
                                            <td>{{ $student->parent_phone }}</td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="5" class="text-center">No students in this classroom.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        @else
                            <table class="table align-middle table-row-dashed fs-6 gy-5">
                                <thead class="text-gray-500 fw-bold text-uppercase">
                                    <tr>
                                        <th class="min-w-50px">#</th>
                                        <th class="min-w-150px">Name</th>
                                        <th class="min-w-100px">NIS</th>
                                        <th class="min-w-100px">Gender</th>
                                        <th class="min-w-150px">Parent Phone</th>
                                    </tr>
                                </thead>
                                <tbody class="text-gray-600 fw-semibold">
                                    <tr>
                                        <td colspan="5" class="text-center">No students in this classroom.</td>
                                    </tr>
                                </tbody>
                            </table>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    @endforeach
</div>
@endsection

@section('scripts')
<script>
    $(document).ready(function () {
        // Inisialisasi DataTables untuk setiap tabel dengan class 'datatable'
        $('.datatable').each(function () {
            $(this).DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": true,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
                "language": {
                    "search": "Search:",
                    "paginate": {
                        "next": "Next",
                        "previous": "Previous"
                    }
                }
            });
        });
    });
</script>
@endsection