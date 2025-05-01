<?php

namespace App\Http\Controllers;

use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TeacherController extends Controller
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
                return redirect()->back()->withErrors(['message' => 'Access denied.']);

            }

            if ($user->level !== 'admin' && $user->level !== 'guru') {
                return redirect()->route('teacher.login')->withErrors(['message' => 'Access denied.']);
            }

            return $next($request);
        });
    }

    public function index()
    {
        $teachers = Teacher::all();
        $breadcrumbs = [
            ['label' => 'Home', 'url' => route('dashboard')],
            ['label' => 'Teachers', 'url' => '']
        ];
        $title = 'Teachers';
        $description = 'Manage all teachers in the system.';

        return view('teachers.index', compact('teachers', 'breadcrumbs', 'title', 'description'));
    }

    public function create()
    {
        $breadcrumbs = [
            ['label' => 'Home', 'url' => route('dashboard')],
            ['label' => 'Teachers', 'url' => route('teachers.index')],
            ['label' => 'Create', 'url' => '']
        ];
        $title = 'Create Teacher';
        $description = 'Add a new teacher to the system.';

        return view('teachers.create', compact('breadcrumbs', 'title', 'description'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nip' => 'required|unique:teachers,nip',
            'full_name' => 'required',
            'password' => 'required|min:6',
            'level' => 'required|in:admin,waka,guru',
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

        try {
            Teacher::create($request->all());
            return redirect()->route('teachers.index')->with('success', 'Teacher data has been added successfully.');
        } catch (\Exception $e) {
            return back()->with('error', 'Failed to add teacher: ' . $e->getMessage())->withInput();
        }
    }

    public function edit(Teacher $teacher)
    {
        $breadcrumbs = [
            ['label' => 'Home', 'url' => route('dashboard')],
            ['label' => 'Teachers', 'url' => route('teachers.index')],
            ['label' => 'Edit', 'url' => '']
        ];
        $title = 'Edit Teacher';
        $description = 'Edit the details of the teacher.';

        return view('teachers.edit', compact('teacher', 'breadcrumbs', 'title', 'description'));
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
