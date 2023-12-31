<?php

namespace App\Http\Controllers;

use App\Models\Assessment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class AssessmentController extends Controller
{
    public function index()
    {
        if (auth()->user()->type !== 'teacher')
            return redirect('/dashboard');

        // Get all courses for the teacher
        $teacherCourses = auth()->user()->teacherCourses();
        
        foreach(  $teacherCourses as $course){
            Log::info($course->assessments());
            info('.......');
        }

        dd($teacherCourses);
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
            'course_id' => 'required|array',
            'course_id.*' => 'exists:courses,id', // Adjust 'courses' with the actual table name for courses
            'body' => 'required|string',
        ]);

        // Create a new Assessment instance using the fillable attributes
        $assessment = new Assessment([
            'title' => $request->input('title'),
            'type' => $request->input('type'),
            'body' => $request->input('body'),
        ]);
        $assessment->save();

        $courses = $request->input('course_id');
        foreach ($courses as $course) {
            // Attach courses to the assessment
            $assessment->courses()->attach($course);
        }

        return redirect()->route('assessments.index')->with('success', 'Assessment created successfully.');
    }
}
