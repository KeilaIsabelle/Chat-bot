<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AttType extends Model
{
    protected $fillable = ['name', 'request_type_id'];

    public function requestType()
    {
        return $this->belongsTo(TypeReqs::class);
    }

    public function attachments()
    {
        return $this->hasMany(Attachment::class);
    }
    //
}
