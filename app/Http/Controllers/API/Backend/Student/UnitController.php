<?php

namespace App\Http\Controllers\API\Backend\Student;

use App\Http\Controllers\Controller;
use App\Http\Requests\TopicSubmissionSaveRequest;
use App\Models\Academic\Subject;
use App\Models\Academic\UserSubmission;
use App\Models\FileAttachment;
use Illuminate\Http\Request;

class UnitController extends Controller
{
    public function topics(Subject $unit)
    {
        try {
            $unit = $unit->load('topics');

            foreach ($unit->topics as $key => $topic) {
                $attachments = $topic->attachments;
                $attachments = FileAttachment::whereIn('id', json_decode($attachments))
                    ->get();
                $unit->topics[$key]->attachments = $attachments;
            }
            return response()->json($unit);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => "Somethig went wrong",
                'error' => $th->getMessage(),
            ], 500);
        }
    }

    public function completedTopics(Subject $unit)
    {
        try {
            $ids = $unit->topics->pluck('id');
            $submissions = UserSubmission::whereIn('topic_id', $ids)->get();

            return response()->json($submissions);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => "Somethig went wrong",
                'error' => $th->getMessage(),
            ], 500);
        }
    }

    public function submitTopic(Subject $unit, $topic, TopicSubmissionSaveRequest $request)
    {
        try {
            $request->save($topic);

            return response()->json([
                'message' => "Topic submitted successfully",
            ], 201);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => "Somethig went wrong",
                'error' => $th->getMessage(),
            ], 500);
        }
    }
}
