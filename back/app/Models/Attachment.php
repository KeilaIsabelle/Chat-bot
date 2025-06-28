<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Attachment extends Model
{
     protected $fillable = ['protocol', 'url', 'attachment_type_id'];

    public function request()
    {
        return $this->belongsTo(Request::class, 'protocol', 'protocol');
    }

    public function attachmentType()
    {
        return $this->belongsTo(AttType::class);
    }
    //
}
