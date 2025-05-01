<?php

namespace App\Http\Controllers;

use App\Models\Classroom;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClassroomSettingController extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            if (!Auth::guard('teacher')->check()) {
                return redirect()->route('teacher.login')->withErrors(['message' => 'Please login first.']);
            }

            $user = Auth::guard('teacher')->user();

            if ($user->level !== 'admin') {
                return redirect()->back()->withErrors(['message' => 'Access denied.']);
            }

            return $next($request);
        });
    }

    public function index(Request $request)
    {
        $classroomId = $request->get('classroom_id');

        if ($classroomId === 'no_class') {
            $students = Student::whereNull('classroom_id')->get();
        } elseif ($classroomId) {
            $students = Student::where('classroom_id', $classroomId)->get();
        } else {
            $students = Student::all();
        }

        $classrooms = Classroom::all();

        $breadcrumbs = [
            ['label' => 'Home', 'url' => route('dashboard')],
            ['label' => 'Classroom Settings', 'url' => '']
        ];
        $title = 'Classroom Settings';
        $description = 'Manage classroom settings and student assignments.';

        return view('classrooms.settings', compact('students', 'classrooms', 'breadcrumbs', 'title', 'description'));
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
