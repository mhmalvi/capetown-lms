<?php

namespace App\Http\Controllers\API\Backend\Student;

use App\Http\Controllers\Controller;
use App\Models\Academic\Course;
use App\Models\StudentSubjectProgress;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function units(Course $course)
    {
        try {
            return response()->json($course->load("units", "courseCategory"));
        } catch (\Throwable $th) {
            return response()->json([
                'message' => $th->getMessage(),
            ], 500);
        }
    }

    public function completed_units(Course $course)
    {
        try {
            return StudentSubjectProgress::where('user_id', auth()->user()->id)
                ->where('subject_id', $course->id)
                ->where('completed', true)
                ->get();
        } catch (\Throwable $th) {
            return response()->json([
                'message' => "Something went wrong",
                'error' => $th->getMessage(),
            ], 500);
        }
    }
}
