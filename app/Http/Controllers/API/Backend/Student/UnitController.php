<?php

namespace App\Http\Controllers\API\Backend\Student;

use App\Http\Controllers\Controller;
use App\Models\Academic\Subject;
use Illuminate\Http\Request;

class UnitController extends Controller
{
    public function topics(Subject $unit)
    {
        try {
            return response()->json($unit->load('topics', 'course'));
        } catch (\Throwable $th) {
            return response()->json([
                'message' => "Somethig went wrong",
            ], 500);
        }
    }
}
