<?php

namespace App\Models\Academic;

use App\Models\FileAttachment;
use App\Traits\TraitCollection;
use Illuminate\Database\Eloquent\Model;

class Topic extends Model
{
    use TraitCollection;

    protected $table = 'unit_topics';

    protected $guarded = [];

    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }

    public function getAttachmentFilesAttribute()
    {
        $attachments = json_decode($this->attachments);
        return FileAttachment::whereIn('id', $attachments)->get();
    }
}
