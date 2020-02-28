<?php

namespace AtitudeAgenda\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class SubCategoria extends Model
{
    use SoftDeletes;

    protected $connection = 'tenant';
    protected $table = 'sub_categorias';
    protected $primaryKey = 'id';
    protected $fillable = [
      'id',
      'descricao',
      'categoria_id',
      'flag_pagar',
      'flag_receber'
    ];

    public function categoria()
    {
      return $this->hasOne(Categoria::class, 'id', 'categoria_id');
    }

}

