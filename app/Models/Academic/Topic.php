<?php

namespace App\Models\Academic;

use App\Traits\TraitCollection;
use Illuminate\Database\Eloquent\Model;

class Topic extends Model
{
    use TraitCollection;

    protected $table = 'unit_topics';

    protected $guarded = [];
}
