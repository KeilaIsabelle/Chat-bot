<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Attachment extends Model
{
     protected $fillable = ['protocol', 'url', 'type'];

    public function request()
    {
        return $this->belongsTo(Request::class);
    }

    public function attachmentType()
    {
        return $this->belongsTo(AttachmentType::class);
    }
}
