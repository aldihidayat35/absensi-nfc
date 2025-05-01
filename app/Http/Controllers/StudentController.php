<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StudentController extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            if (!Auth::guard('teacher')->check()) {
                return redirect()->route('teacher.login')->withErrors(['message' => 'Please login first.']);
            }

            $user = Auth::guard('teacher')->user();
            $allowedRoutes = ['show'];
            if ($user->level === 'guru' && !in_array($request->route()->getActionMethod(), $allowedRoutes)) {
                return redirect()->route('teacher.login')->withErrors(['message' => 'Access denied.']);
            }
            if ($user->level !== 'admin' && $user->level !== 'guru') {
                return redirect()->route('teacher.login')->withErrors(['message' => 'Access denied.']);
            }

            return $next($request);
        });
    }

    public function index()
    {
        $students = Student::all();
        $breadcrumbs = [
            ['label' => 'Home', 'url' => route('dashboard')],
            ['label' => 'Students', 'url' => '']
        ];
        $title = 'Students';
        $description = 'Manage all students in the system.';

        return view('students.index', compact('students', 'breadcrumbs', 'title', 'description'));
    }

    public function create()
    {
        $breadcrumbs = [
            ['label' => 'Home', 'url' => route('dashboard')],
            ['label' => 'Students', 'url' => route('students.index')],
            ['label' => 'Create', 'url' => '']
        ];
        $title = 'Create Student';
        $description = 'Add a new student to the system.';

        return view('students.create', compact('breadcrumbs', 'title', 'description'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nis' => 'required|unique:students,nis',
            'nfc_uid' => 'nullable|unique:students,nfc_uid', // Validasi NFC UID
            'parent_phone' => 'nullable', // Validasi Parent Phone
            'full_name' => 'required',
            'birth_place' => 'required',
            'birth_date' => 'required|date',
            'gender' => 'required|in:Male,Female',
            'religion' => 'required',
            'address' => 'required',
            'phone' => 'required',
            'email' => 'nullable|email',
            'nationality' => 'required',
            'photo' => 'nullable|image|max:2048',
        ]);

        $data = $request->all();

        // Upload foto jika ada
        if ($request->hasFile('photo')) {
            $file = $request->file('photo');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('photos'), $filename); // Simpan ke folder public/photos
            $data['photo'] = 'photos/' . $filename; // Simpan path ke database
        }

        Student::create($data);

        return redirect()->route('students.index')->with('success', 'Student created successfully.');
    }

    public function edit(Student $student)
    {
        $breadcrumbs = [
            ['label' => 'Home', 'url' => route('dashboard')],
            ['label' => 'Students', 'url' => route('students.index')],
            ['label' => 'Edit', 'url' => '']
        ];
        $title = 'Edit Student';
        $description = 'Edit the details of the student.';

        return view('students.edit', compact('student', 'breadcrumbs', 'title', 'description'));
    }

    public function update(Request $request, Student $student)
    {
        $request->validate([
            'nis' => 'required|unique:students,nis,' . $student->id,
            'nfc_uid' => 'nullable|unique:students,nfc_uid,' . $student->id, // Validasi NFC UID
            'parent_phone' => 'nullable', // Validasi Parent Phone
            'full_name' => 'required',
            'birth_place' => 'required',
            'birth_date' => 'required|date',
            'gender' => 'required|in:Male,Female',
            'religion' => 'required',
            'address' => 'required',
            'phone' => 'required',
            'email' => 'nullable|email',
            'nationality' => 'required',
            'photo' => 'nullable|image|max:2048',
        ]);

        $data = $request->all();

        // Upload foto jika ada
        if ($request->hasFile('photo')) {
            // Hapus foto lama jika ada
            if ($student->photo && file_exists(public_path($student->photo))) {
                unlink(public_path($student->photo));
            }

            $file = $request->file('photo');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('photos'), $filename); // Simpan ke folder public/photos
            $data['photo'] = 'photos/' . $filename; // Simpan path ke database
        }

        $student->update($data);

        return redirect()->route('students.index')->with('success', 'Student updated successfully.');
    }

    public function destroy(Student $student)
    {
        $student->delete();
        return redirect()->route('students.index')->with('success', 'Student deleted successfully.');
    }

    public function show(Student $student)
    {
        return view('students.show', compact('student'));
    }
}