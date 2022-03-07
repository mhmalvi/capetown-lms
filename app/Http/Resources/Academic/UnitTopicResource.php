<?php

namespace App\Http\Resources\Academic;

use Illuminate\Http\Resources\Json\JsonResource;

class UnitTopicResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'subject_id' => $this->subject_id,
            'subject' => $this->subject,
            'order' => $this->order,
            'description' => $this->description,
            'attachments' => $this->attachment_files,
            'can_user_submit' => $this->can_user_submit,
            'created_at' => $this->created_at->diffForHumans(),
        ];
    }
}
