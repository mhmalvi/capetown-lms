<?php

namespace App\Http\Requests;

use App\Models\Academic\UserSubmission;
use App\Models\FileAttachment;
use App\Services\FileHandler;
use Illuminate\Foundation\Http\FormRequest;

class TopicSubmissionSaveRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->user()->user_type == 'student';
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [];
    }

    public function save($topic)
    {
        $attachment_ids = $this->uploadFiles();

        UserSubmission::create([
            'user_id' => auth()->user()->id,
            'topic_id' => $topic,
            'assessment' => $this->description ?? null,
            'attachments' => json_encode($attachment_ids),
        ]);
    }

    private function uploadFiles()
    {
        $ids = [];
        foreach ($this->attachments as $attachment) {
            $file_handler = new FileHandler($attachment['file']);

            $file_handler->setPath('course_units/topics')
                ->setName($attachment['name'])
                ->save();

            $fa = FileAttachment::create([
                'file_name' => $file_handler->getName(),
                'file_path' => $file_handler->getPath(),
                'extension' => $file_handler->getExtension(),
            ]);
            $ids[] = $fa->id;
        }
        return $ids;
    }
}
