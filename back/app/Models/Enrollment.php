<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Enrollment extends Model
{
    // use HasFactory;

    protected $fillable = [
        'enrollment',
        'timetable',
        'modality',
        'status',
        'user_id',
    ];

    /**
     * Um enrollment pertence a um usuário.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
