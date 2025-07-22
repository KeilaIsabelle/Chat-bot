<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Request extends Model
{
    protected $fillable = [
      'status',
      'enrollment',
      'observations',
      'protocol',
      'req_type'
    ];

    public function requestType()
    {
        return $this->belongsTo(RequestType::class);
    }

    public function attachment()
    {
        return $this->hasMany(Attachment::class);
    }
}
