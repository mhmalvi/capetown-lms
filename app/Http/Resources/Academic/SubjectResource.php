<?php

namespace App\Http\Resources\Academic;

use App\CrudMachanism\ImageCustomize;
use Illuminate\Http\Resources\Json\JsonResource;

class SubjectResource extends JsonResource
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
            'course_id' => $this->course_id,
            'course' => $this->course->title,
            'title' => $this->title,
            'description' => $this->description,
            'thumbnail'          => $this->thumbnail,
            'thumbnail_view'     => ImageCustomize::customize('course_units', $this->thumbnail),
            'type' => $this->type,
            'created_at' => $this->created_at->diffForHumans()
        ];
    }
}
