<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TypeReqs extends Model
{
     protected $fillable = ['name'];

    public function requests()
    {
        return $this->hasMany(Request::class);
    }

    public function attachmentTypes()
    {
        return $this->hasMany(AttType::class);
    }
    //
}
