<?php

namespace App\Http\Controllers\API\Backend\Student;

use App\Http\Controllers\Controller;
use App\Models\Academic\Course;
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
}
