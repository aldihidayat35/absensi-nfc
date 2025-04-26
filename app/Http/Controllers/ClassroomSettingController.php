<?php

namespace App\Http\Controllers;

use App\Models\Classroom;
use App\Models\Student;
use Illuminate\Http\Request;

class ClassroomSettingController extends Controller
{
    public function index(Request $request)
    {
        $classroomId = $request->get('classroom_id');

        if ($classroomId === 'no_class') {
            // Siswa tanpa kelas
            $students = Student::whereNull('classroom_id')->get();
        } elseif ($classroomId) {
            // Siswa dalam kelas tertentu
            $students = Student::where('classroom_id', $classroomId)->get();
        } else {
            // Semua siswa
            $students = Student::all();
        }

        $classrooms = Classroom::all(); // Semua kelas
        return view('classrooms.settings', compact('students', 'classrooms'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'student_ids' => 'required|array',
            'student_ids.*' => 'exists:students,id',
            'classroom_id' => 'required|exists:classrooms,id',
        ]);

        // Update classroom_id untuk siswa yang dipilih
        Student::whereIn('id', $request->student_ids)->update(['classroom_id' => $request->classroom_id]);

        return redirect()->route('classrooms.settings')->with('success', 'Students moved successfully.');
    }
}
