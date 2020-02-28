<?php

namespace AtitudeAgenda\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Pacote extends Model
{
    use SoftDeletes;

    protected $connection = 'tenant';
    protected $table = 'pacotes';
    protected $primaryKey = 'id';
    protected $fillable = [
      'id', 
      'descricao',
      'valor',
      'padrao',
      'categoria_id',
      'sub_categoria_id',
      'licenciado_id'
    ];

    public function pacoteServicos() {
      return $this->hasMany(PacoteServico::class,
      
        'pacote_id',
        'id',
        'servico_id');
    }

    public function categoria() {
      return $this->hasOne(Categoria::class,
        'id',
        'categoria_id');
    }

    public function subCategoria() {
      return $this->hasOne(SubCategoria::class,
        'id',
        'sub_categoria_id');
    }
    /**
     * Sets Attributes
     * @insert to database the attribute value
     */

    public function setDescricaoAttribute($value)
    {
      $this->attributes['descricao'] = $value ;
    }

    public function setValorAttribute($value)
    {
       $this->attributes['valor'] = str_replace(',','.',str_replace('.',',',$value));
    }

    public function getDescricaoAttribute($value)
    {
      return $value ;
    }


    public function getValorAttribute($value)
    {
      return number_format($value,2,',','.');
    }

    static public function getCategory($id)
    {
      return Pacote::where('id',$id)
              ->with('pacoteServicos.servico.categoria.subCategoria')->first();
    
            }

}