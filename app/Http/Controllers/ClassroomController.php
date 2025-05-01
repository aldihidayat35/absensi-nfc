<?php

namespace App\Http\Controllers;

use App\Models\Classroom;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClassroomController extends Controller
{
    // Tambahkan middleware ke dalam konstruktor
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            if (!Auth::guard('teacher')->check()) {
                return redirect()->route('teacher.login')->withErrors(['message' => 'Please login first.']);
            }

            $user = Auth::guard('teacher')->user();
            $allowedRoutes = ['overview'];

            if ($user->level === 'guru' && !in_array($request->route()->getActionMethod(), $allowedRoutes)) {
                return redirect()->route('classrooms.overview')->withErrors(['message' => 'Access denied.']);
            }

            if ($user->level !== 'admin' && $user->level !== 'guru') {
                return redirect()->route('teacher.login')->withErrors(['message' => 'Access denied.']);
            }

            return $next($request);
        });
    }

    public function index()
    {
        $classrooms = Classroom::all();
        $breadcrumbs = [
            ['label' => 'Home', 'url' => route('dashboard')],
            ['label' => 'Classrooms', 'url' => '']
        ];
        $title = 'Classrooms';
        $description = 'Manage all classrooms in the system.';

        return view('classrooms.index', compact('classrooms', 'breadcrumbs', 'title', 'description'));
    }

    public function create()
    {
        $breadcrumbs = [
            ['label' => 'Home', 'url' => route('dashboard')],
            ['label' => 'Classrooms', 'url' => route('classrooms.index')],
            ['label' => 'Create', 'url' => '']
        ];
        $title = 'Create Classroom';
        $description = 'Add a new classroom to the system.';

        return view('classrooms.create', compact('breadcrumbs', 'title', 'description'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:classrooms,name',
            'academic_year' => 'required',
        ]);

        Classroom::create($request->all());
        return redirect()->route('classrooms.index')->with('success', 'Classroom created successfully.');
    }

    public function edit(Classroom $classroom)
    {
        $breadcrumbs = [
            ['label' => 'Home', 'url' => route('dashboard')],
            ['label' => 'Classrooms', 'url' => route('classrooms.index')],
            ['label' => 'Edit', 'url' => '']
        ];
        $title = 'Edit Classroom';
        $description = 'Edit the details of the classroom.';

        return view('classrooms.edit', compact('classroom', 'breadcrumbs', 'title', 'description'));
    }

    public function update(Request $request, Classroom $classroom)
    {
        $request->validate([
            'name' => 'required|unique:classrooms,name,' . $classroom->id,
            'academic_year' => 'required',
        ]);

        $classroom->update($request->all());
        return redirect()->route('classrooms.index')->with('success', 'Classroom updated successfully.');
    }

    public function destroy(Classroom $classroom)
    {
        $classroom->delete();
        return redirect()->route('classrooms.index')->with('success', 'Classroom deleted successfully.');
    }

    public function show($id)
    {
        $classroom = Classroom::with('students')->findOrFail($id);
        $breadcrumbs = [
            ['label' => 'Home', 'url' => route('dashboard')],
            ['label' => 'Classrooms', 'url' => route('classrooms.index')],
            ['label' => $classroom->name, 'url' => '']
        ];
        $title = 'Classroom Details';
        $description = 'View details of the classroom.';

        return view('classrooms.show', compact('classroom', 'breadcrumbs', 'title', 'description'));
    }
    public function overview()
    {
        $classrooms = Classroom::with('students')->get();
        $breadcrumbs = [
            ['label' => 'Home', 'url' => route('dashboard')],
            ['label' => 'Classrooms', 'url' => route('classrooms.index')],
            ['label' => 'Overview', 'url' => '']
        ];
        $title = 'Classroom Overview';
        $description = 'View all classrooms and their details.';

        return view('classrooms.overview', compact('classrooms', 'breadcrumbs', 'title', 'description'));
    }
}