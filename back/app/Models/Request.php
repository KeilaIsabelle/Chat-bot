<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Request extends Model
{
    protected $fillable = ['status', 'matricula', 'observacoes', 'protocolo', 'data_atual', 'tipo_req'];

    public function tipoRequerimento()
    {
        return $this->belongsTo(TypeReqs::class, 'tipo_req');
    }

    public function anexos()
    {
        return $this->hasMany(Attachment::class, 'protocolo', 'protocolo');
    }
    //
}
