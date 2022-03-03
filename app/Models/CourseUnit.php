<?php

namespace App\Models;

use App\Traits\TraitCollection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CourseUnit extends Model
{
    use TraitCollection;

    protected $fillable = ['name'];
}
