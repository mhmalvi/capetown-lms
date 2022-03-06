<?php

namespace App\Http\Requests\Academic;

use App\Models\Academic\Subject;
use App\Models\Academic\Topic;
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

        $this->saveTopic(1, $this->topic_1);
        $this->saveTopic(2, $this->topic_2);
        $this->saveTopic(3, $this->topic_3);
        $this->saveTopic(4, $this->topic_4);
        $this->saveTopic(5, $this->topic_5);
    }

    private function saveTopic($order, $description)
    {
        Topic::updateOrCreate([
            'subject_id' => $this->subject_id,
            'order' => $order,
        ], [
            'description' => $description
        ]);
    }
}
