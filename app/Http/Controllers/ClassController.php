<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\SchoolClass;
use Illuminate\Http\Request;
use App\Http\Requests\StoreClassRequest;

class ClassController extends Controller
{
    public function store(StoreClassRequest $request)
    {
        return SchoolClass::create($request->validated());
    }

    public function index()
    {
        return SchoolClass::with('students')->get();
    }

    public function assignStudent(Student $student, SchoolClass $class)
    {
        if ($class->students()->count() >= $class->max_students) {
            return response()->json([
                'message' => 'Class is full.'
            ], 400);
        }

        $student->classes()->syncWithoutDetaching([$class->id]);

        return response()->json(['message' => 'Student assigned']);
    }



}
