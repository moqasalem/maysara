<?php

namespace App\Http\Controllers;

use App\Models\CourseStudent;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CourseController extends Controller
{
    public function index()
    {
        if (auth()->user()->type == 'teacher')
            $courses = auth()->user()->teacherCourses;
        else {
            $courses = auth()->user()->studentCourses()->with('course')->get();
        }
        return view('courses.index', compact('courses'));
    }

    public function create()
    {
        $students = User::query()->where('type', 'student')->get();
        return view('courses.create', compact('students'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            "name" => "required",
            "user_id" => "required"
        ]);
        DB::transaction(function () use ($validatedData) {
            $course = auth()->user()->teacherCourses()->create($validatedData);
            foreach ($validatedData['user_id'] as $user) {
                CourseStudent::create(['course_id' => $course->id, 'student_id' => $user]);
            }
        });
        return redirect()->route('courses.index');
    }
}
