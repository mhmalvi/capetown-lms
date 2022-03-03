<?php

namespace App\Models\Academic;

use App\Traits\TraitCollection;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use TraitCollection;

    protected $fillable = [
        'uuid', 'code', 'title', 'slug', 'course_category_id', 'description', 'thumbnail', 'alt', 'publish',
    ];

    public function courseCategory()
    {
        return $this->belongsTo(CourseCategory::class, 'course_category_id' );
    }
}
