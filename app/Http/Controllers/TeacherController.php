<?php

namespace App\Http\Controllers;

use App\Models\Teacher;
use Illuminate\Http\Request;

class TeacherController extends Controller
{
    public function index()
    {
        $teachers = Teacher::all();
        return view('teachers.index', compact('teachers'));
    }

    public function create()
    {
        return view('teachers.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nip' => 'required|unique:teachers,nip|max:20',
            'full_name' => 'required|max:100',
            'gender' => 'required|in:Male,Female',
            'birth_place' => 'required|max:50',
            'birth_date' => 'required|date',
            'religion' => 'required|max:20',
            'phone' => 'required|max:15',
            'email' => 'required|email|unique:teachers,email|max:100',
            'address' => 'required',
            'status' => 'required|in:aktif,tidak aktif',
            'photo' => 'nullable|image|max:2048',
            'position' => 'required|max:50',
            'subject' => 'required|max:100',
        ]);

        $data = $request->all();

        if ($request->hasFile('photo')) {
            $file = $request->file('photo');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('photos'), $filename);
            $data['photo'] = 'photos/' . $filename;
        }

        Teacher::create($data);

        return redirect()->route('teachers.index')->with('success', 'Teacher created successfully.');
    }

    public function edit(Teacher $teacher)
    {
        return view('teachers.edit', compact('teacher'));
    }

    public function update(Request $request, Teacher $teacher)
    {
        $request->validate([
            'nip' => 'required|unique:teachers,nip,' . $teacher->id . '|max:20',
            'full_name' => 'required|max:100',
            'gender' => 'required|in:Male,Female',
            'birth_place' => 'required|max:50',
            'birth_date' => 'required|date',
            'religion' => 'required|max:20',
            'phone' => 'required|max:15',
            'email' => 'required|email|unique:teachers,email,' . $teacher->id . '|max:100',
            'address' => 'required',
            'status' => 'required|in:aktif,tidak aktif',
            'photo' => 'nullable|image|max:2048',
            'position' => 'required|max:50',
            'subject' => 'required|max:100',
        ]);

        $data = $request->all();

        if ($request->hasFile('photo')) {
            if ($teacher->photo && file_exists(public_path($teacher->photo))) {
                unlink(public_path($teacher->photo));
            }

            $file = $request->file('photo');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('photos'), $filename);
            $data['photo'] = 'photos/' . $filename;
        }

        $teacher->update($data);

        return redirect()->route('teachers.index')->with('success', 'Teacher updated successfully.');
    }

    public function destroy(Teacher $teacher)
    {
        if ($teacher->photo && file_exists(public_path($teacher->photo))) {
            unlink(public_path($teacher->photo));
        }

        $teacher->delete();

        return redirect()->route('teachers.index')->with('success', 'Teacher deleted successfully.');
    }

    public function show(Teacher $teacher)
    {
        return view('teachers.show', compact('teacher'));
    }
}
