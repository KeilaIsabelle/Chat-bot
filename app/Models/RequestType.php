<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RequestType extends Model
{
     protected $fillable = ['name'];

    public function request()
    {
        return $this->hasMany(Request::class);
    }

    public function attachmentType()
    {
        return $this->hasMany(AttachmentType::class);
    }
}
