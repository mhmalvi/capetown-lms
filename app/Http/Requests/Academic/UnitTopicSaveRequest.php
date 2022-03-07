<?php

namespace App\Http\Requests\Academic;

use App\Models\Academic\Subject;
use App\Models\Academic\Topic;
use App\Models\FileAttachment;
use App\Services\FileHandler;
use Illuminate\Foundation\Http\FormRequest;

class UnitTopicSaveRequest extends FormRequest
{
    private $subject_id = null;

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'topic_1' => 'required',
            'topic_2' => 'required',
            'topic_3' => 'required',
            'topic_4' => 'required',
            'topic_5' => 'required',
        ];
    }

    public function save(Subject $subject)
    {
        $this->subject_id = $subject->id;

        $this->saveTopic(1, $this->topic_1, $this->topic_1_user_submission);
        $this->saveTopic(2, $this->topic_2, $this->topic_2_user_submission);
        $this->saveTopic(3, $this->topic_3, $this->topic_3_user_submission);
        $this->saveTopic(4, $this->topic_4, $this->topic_4_user_submission);
        $this->saveTopic(5, $this->topic_5, $this->topic_5_user_submission);
    }

    private function saveTopic($order, $description, $can_user_submit)
    {
        $ids = $this->uploadFiles($this->topic_files[$order]);

        Topic::updateOrCreate([
            'subject_id' => $this->subject_id,
            'order' => $order,
        ], [
            'description' => $description,
            'attachments' => json_encode($ids),
            'can_user_submit' => $can_user_submit,
        ]);
    }

    private function uploadFiles($topic_files)
    {
        $ids = [];
        foreach ($topic_files as $file) {
            $file_handler = new FileHandler($file['file']);
            $file_handler->setName($file['name'])
                ->setPath("testing")
                ->save();

            $attachment = new FileAttachment;

            $attachment->file_name  = $file_handler->getName();
            $attachment->file_path  = $file_handler->getPath();
            $attachment->extension  = $file_handler->getExtension();

            $attachment->save();

            $ids[] = $attachment->id;
        }

        return $ids;
    }
}
