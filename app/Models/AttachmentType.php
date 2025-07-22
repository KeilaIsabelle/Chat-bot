<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AttachmentType extends Model
{
    protected $fillable = ['name', 'req_type'];

    public function requestType()
    {
        return $this->belongsTo(RequestType::class);
    }

    public function attachment()
    {
        return $this->hasMany(Attachment::class);
    }

}
