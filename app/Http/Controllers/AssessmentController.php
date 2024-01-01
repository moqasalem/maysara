<?php

namespace App\Http\Controllers;

use App\Models\Assessment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class AssessmentController extends Controller
{
    public function index()
    {
        // Check if the user is a teacher
        if (auth()->user()->type !== 'teacher') {
            return redirect('/dashboard');
        }

        // Get all courses for the teacher and retrieve their IDs
        $teacherCoursesIds = auth()->user()->teacherCourses->pluck('id')->toArray();

        // Get assessments for the teacher's courses
        $assessments = Assessment::whereIn('course_id', $teacherCoursesIds)->get();

        // You can use the $assessments array as needed, for example, pass it to the view
        return view('assessments.index', compact('assessments'));
    }


    public function create()
    {
        $courses = auth()->user()->teacherCourses;
        return view('assessments.create', compact('courses'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'type' => 'required|string|in:quiz,question',
            'course_id' => 'required',
            'body' => 'required|string',
        ]);

        // Create a new Assessment instance using the fillable attributes
        $assessment = new Assessment([
            'course_id' => $request->input('course_id'),
            'title' => $request->input('title'),
            'type' => $request->input('type'),
            'body' => $request->input('body'),
        ]);
        $assessment->save();

        return redirect()->route('assessments.index')->with('success', 'Assessment created successfully.');
    }
}
