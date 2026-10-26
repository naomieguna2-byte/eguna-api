<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class StudentController extends Controller
{
    
    public function index()
    {
        return response()->json(Student::all(), 200);
    }

    
    public function store(Request $request)
    {
        $validated = $request->validate([
            'student_number' => 'required|string|max:50|unique:students,student_number',
            'firstname' => 'required|string|max:255',
            'middlename' => 'nullable|string|max:255',
            'lastname' => 'required|string|max:255',
            'email' => 'required|email|unique:students,email',
            'course' => 'required|string|max:255',
            'year_level' => 'required|integer|min:1|max:6',
        ]);

        $student = Student::create($validated);

        return response()->json([
            'message' => 'Student created successfully.',
            'data' => $student,
        ], 201);
    }

    
    public function show(string $id)
    {
        $student = Student::find($id);

        if (!$student) {
            return response()->json([
                'message' => 'Student not found.',
            ], 404);
        }

        return response()->json($student, 200);
    }

    
    public function update(Request $request, string $id)
    {
        $student = Student::find($id);

        if (!$student) {
            return response()->json([
                'message' => 'Student not found.',
            ], 404);
        }

        $validated = $request->validate([
            'student_number' => [
                'sometimes',
                'required',
                'string',
                'max:50',
                Rule::unique('students', 'student_number')
                    ->ignore($student->id),
            ],
            'firstname' => 'sometimes|required|string|max:255',
            'middlename' => 'sometimes|nullable|string|max:255',
            'lastname' => 'sometimes|required|string|max:255',
            'email' => [
                'sometimes',
                'required',
                'email',
                Rule::unique('students', 'email')
                    ->ignore($student->id),
            ],
            'course' => 'sometimes|required|string|max:255',
            'year_level' => 'sometimes|required|integer|min:1|max:6',
        ]);

        $student->update($validated);

        return response()->json([
            'message' => 'Student updated successfully.',
            'data' => $student->fresh(),
        ], 200);
    }

    
    public function destroy(string $id)
    {
        $student = Student::find($id);

        if (!$student) {
            return response()->json([
                'message' => 'Student not found.',
            ], 404);
        }

        $student->delete();

        return response()->json([
            'message' => 'Student deleted successfully.',
        ], 200);
    }
}
