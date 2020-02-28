<?php

namespace AtitudeAgenda\Models;
use Illuminate\Database\Eloquent\SoftDeletes;


use Illuminate\Database\Eloquent\Model;

class TotalSubCategoria extends Model
{
    use SoftDeletes;

    protected $connection = 'tenant';
    protected $table = 'totais_sub_categorias';
    protected $primaryKey = 'id';
    protected $fillable = [
        'ano',
        'mes',
        'previsto',
        'realizado',
        'sub_categoria_id',
        'totais_categorias_id',
        'licenciado_id'
        ];

    public function subCategoria()
    {
        return $this->hasOne(SubCategoria::class, 'id', 'sub_categoria_id');
    }

    public function totalCategoria()
    {
        return $this->hasOne(TotalCategoria::class, 'id', 'totais_categorias_id');
    }
}
