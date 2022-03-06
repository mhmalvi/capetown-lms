<?php

namespace App\Models\Academic;

use App\Traits\TraitCollection;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    use TraitCollection;

    protected $guarded = [];

    public function topics()
    {
        return $this->hasMany(Topic::class, 'subject_id', 'id');
    }

    public function course()
    {
        return $this->belongsTo(Course::class);
    }
}
