<?php

namespace App\Http\Controllers\API\Backend\Academic;

use App\Http\Controllers\Controller;
use App\Http\Requests\Academic\UnitTopicSaveRequest;
use App\Http\Resources\Academic\UnitTopicResource;
use App\Models\Academic\Subject;

class UnitTopicController extends Controller
{
    public function get(Subject $subject)
    {
        if ($subject->topics->isEmpty()) {
            return response()->json([
                'message' => 'No topics found.',
                'data'    => [],
            ], 200);
        }
        return UnitTopicResource::collection($subject->topics);
    }

    public function store(Subject $subject, UnitTopicSaveRequest $request)
    {
        try {
            $request->save($subject);

            return response()->json([
                'message' => "Successfully saved the topics",
            ], 201);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => "Something went wrong while saving unit topics",
                'error' => $th->getMessage(),
            ], 500);
        }
    }
}
