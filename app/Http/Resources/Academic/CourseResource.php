<?php

namespace App\Http\Resources\Academic;

use App\CrudMachanism\ImageCustomize;
use Illuminate\Http\Resources\Json\JsonResource;

class CourseResource extends JsonResource
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
            'id'                 => $this->id,
            'uuid'               => $this->uuid,
            'code'               => $this->code,
            'title'              => $this->title,
            'slug'               => $this->slug,
            'course_category_id' => $this->course_category_id,
            'course_category_name' => $this->courseCategory->name ?? '',
            'description'        => $this->description,
            'thumbnail'          => $this->thumbnail,
            'thumbnail_view'          => ImageCustomize::customize('course', $this->thumbnail),
        ];
    }
}
