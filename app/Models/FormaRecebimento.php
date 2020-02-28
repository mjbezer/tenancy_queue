<?php

namespace AtitudeAgenda\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FormaRecebimento extends Model
{
    use SoftDeletes;

    protected $connection = 'tenant';
    protected $table = 'formas_recebimentos';
    protected $primaryKey = 'id';
    protected $fillable = ['forma', 'status', 'licenciado_id'];
}
