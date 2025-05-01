<?php

namespace App\Http\Controllers;

use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SubjectController extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            if (!Auth::guard('teacher')->check()) {
                return redirect()->route('teacher.login')->withErrors(['message' => 'Please login first.']);
            }

            $user = Auth::guard('teacher')->user();

            if ($user->level !== 'admin') {
                return redirect()->route('dashboard')->withErrors(['message' => 'Access denied.']);
            }

            return $next($request);
        });
    }

    public function index()
    {
        $subjects = Subject::all();
        $breadcrumbs = [
            ['label' => 'Home', 'url' => route('dashboard')],
            ['label' => 'Subjects', 'url' => '']
        ];
        $title = 'Subjects';
        $description = 'Manage all subjects in the system.';

        return view('subjects.index', compact('subjects', 'breadcrumbs', 'title', 'description'));
    }

    public function create()
    {
        $breadcrumbs = [
            ['label' => 'Home', 'url' => route('dashboard')],
            ['label' => 'Subjects', 'url' => route('subjects.index')],
            ['label' => 'Create', 'url' => '']
        ];
        $title = 'Create Subject';
        $description = 'Add a new subject to the system.';

        return view('subjects.create', compact('breadcrumbs', 'title', 'description'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'nullable|string|max:50|unique:subjects,code',
            'group' => 'required|string',
            'description' => 'nullable|string',
        ]);

        Subject::create($request->all());
        return redirect()->route('subjects.index')->with('success', 'Subject created successfully.');
    }

    public function edit(Subject $subject)
    {
        $breadcrumbs = [
            ['label' => 'Home', 'url' => route('dashboard')],
            ['label' => 'Subjects', 'url' => route('subjects.index')],
            ['label' => 'Edit', 'url' => '']
        ];
        $title = 'Edit Subject';
        $description = 'Edit the details of the subject.';

        return view('subjects.edit', compact('subject', 'breadcrumbs', 'title', 'description'));
    }

    public function update(Request $request, Subject $subject)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'nullable|string|max:50|unique:subjects,code,' . $subject->id,
            'group' => 'required|string',
            'description' => 'nullable|string',
        ]);

        $subject->update($request->all());
        return redirect()->route('subjects.index')->with('success', 'Subject updated successfully.');
    }

    public function destroy(Subject $subject)
    {
        $subject->delete();
        return redirect()->route('subjects.index')->with('success', 'Subject deleted successfully.');
    }
}
