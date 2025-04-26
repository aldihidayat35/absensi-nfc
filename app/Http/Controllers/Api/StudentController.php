<?php

namespace App\Http\Controllers\Api;

use App\Models\Student;
use App\Models\Classroom;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class StudentController extends Controller
{
    public function index()
    {
        $students = Student::all();
        return view('students.index', compact('students'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nis' => 'required|unique:students',
            'name' => 'required',
            'nfc_uid' => 'required|unique:students',
            'parent_phone' => 'nullable',
            'status' => 'nullable|in:Aktif,Pindah,Lulus,Tidak Aktif',
            'classroom_id' => 'required|exists:classrooms,id',
        ]);

        $student = Student::create($validated);
        $student->classrooms()->attach($validated['classroom_id'], ['is_active' => true]);

        return response()->json($student->load('classrooms'), 201);
    }

    public function show($id)
    {
        return Student::with('classrooms')->findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $student = Student::findOrFail($id);

        $validated = $request->validate([
            'name' => 'sometimes|required',
            'parent_phone' => 'nullable',
            'status' => 'nullable|in:Aktif,Pindah,Lulus,Tidak Aktif',
        ]);

        $student->update($validated);
        return $student;
    }

    public function destroy($id)
    {
        $student = Student::findOrFail($id);
        $student->classrooms()->detach();
        $student->delete();

        return response()->json(['message' => 'Student deleted']);
    }
}
