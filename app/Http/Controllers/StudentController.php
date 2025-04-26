<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index()
    {
        $students = Student::all();
        return view('students.index', compact('students'));
    }

    public function create()
    {
        return view('students.create');
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
        return view('students.edit', compact('student'));
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