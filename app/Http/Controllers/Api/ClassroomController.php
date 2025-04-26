<?php

namespace App\Http\Controllers\Api;

use App\Models\Classroom;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ClassroomController extends Controller
{
    public function index()
    {
        return Classroom::withCount('students')->get();
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'academic_year' => 'required',
        ]);

        return Classroom::create($validated);
    }

    public function show($id)
    {
        return Classroom::with('students')->findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $classroom = Classroom::findOrFail($id);
        $validated = $request->validate([
            'name' => 'sometimes|required',
            'academic_year' => 'sometimes|required',
        ]);
        $classroom->update($validated);

        return $classroom;
    }

    public function destroy($id)
    {
        $classroom = Classroom::findOrFail($id);
        $classroom->students()->detach();
        $classroom->delete();

        return response()->json(['message' => 'Classroom deleted']);
    }
}
