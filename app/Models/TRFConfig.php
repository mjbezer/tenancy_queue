<?php

namespace AtitudeAgenda\Models;


use Illuminate\Database\Eloquent\Model;

class TRFConfig extends Model
{
    protected $connection = 'tenant';
    protected $table = 'trf_config';
    protected $fillable = [
        'titular',
        'doc',
        'banco',
        'agencia',
        'tipo',
        'conta'
        ];
}
