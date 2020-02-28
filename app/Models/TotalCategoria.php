<?php

namespace AtitudeAgenda\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class TotalCategoria extends Model
{
    use SoftDeletes;

    protected $connection = 'tenant';
    protected $table = 'totais_categorias';
    protected $primaryKey = 'id';
    protected $fillable = [
        'ano',
        'mes',
        'previsto',
        'realizado',
        'categoria_id',
        'receita_despesa',
        'licenciado_id'
        ];

    public $preventAttrSet = true;

    public function categoria()
    {
        return $this->hasOne(Categoria::class, 'id', 'categoria_id');
    } 

    public function TotalSubCategoria()
    {
        return $this->hasMany(TotalSubCategoria::class, 'totais_categorias_id', 'id');
    }

    public function getTotalPrevistoattribute($value)
    {
        if ($this->preventAttrSet) {
            return number_format($value,'2',',','.');
        } else {
            return $value;
          }
    }

    public function getTotalRealizadoattribute($value)
    {
        if ($this->preventAttrSet) {
            return number_format($value,'2',',','.');
        } else {
            return $value;
          }   
    }

    static function getIn($mes, $ano) 
    {
        return TotalCategoria::where(['mes'=> $mes,
                                      'ano'=> $ano,
                                      'receita_despesa'=> 1])
                            ->selectRaw('SUM(previsto) as totalPrevisto')
                            ->selectRaw('SUM(realizado) as totalRealizado')
                            ->first();
    }

    static function getOut($mes, $ano)
    {
        return TotalCategoria::where(['mes'=> $mes,
                                      'ano'=> $ano,
                                      'receita_despesa'=> 0])
                            ->selectRaw('SUM(previsto) as totalPrevisto')
                            ->selectRaw('SUM(realizado) as totalRealizado')
                            ->first();
    }
  
}