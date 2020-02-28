<?php

namespace AtitudeAgenda\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use AtitudeAgenda\User;

class Servico extends Model
{
    use SoftDeletes;

    protected $connection = 'tenant';
    protected $table = 'servicos';
    protected $primaryKey = 'id';
    protected $fillable = [
      'id',
      'ativo',
      'descricao',
      'valor',
      'custo_direto',
      'iss_aliquota',
      'custo_total',
      'observacao',
      'cor_texto',
      'cor_fundo',
      'duracao',
      'categoria_id',
      'sub_categoria_id',
      'licenciado_id'
    ];

    public function licenciado()
    {
      return $this->hasOne(User::class, 'licenciado_id', 'licenciado_id');
    }

    public function categoria()
    {
      return $this->hasOne(Categoria::class,
        'id',
        'categoria_id');
    }

    public function subCategoria()
    {
      return $this->hasOne(SubCategoria::class,
        'id',
        'sub_categoria_id');
    }

    public function pacoteServicos()
    {
      return $this->hasMany(PacoteServico::class,
        'id',
        'servico_id');
    }

    public function detalhePedido()
    {
      return $this->hasMany(DetalhePedido::class,
        'servico_id',
        'id');
    }

    public function agenda()
    {
      return $this->hasMany(Agenda::class,
        'id',
        'servico_id');
    }

    /**
     * Set Attributes
     * Fields descricao to Upper
     *        valor to 0.00
     *        custo_direto to 0.00
     *        iss_aliquota / 100 end to 0.00
     *        custo_total to 0.00 
     */

    public function setDescricaoAttribute($value)
    {
      $this->attributes['descricao'] = $value ;
    }

    public function setValorAttribute($value)
    {
       $this->attributes['valor'] = str_replace(',','.',str_replace('.',',',$value));
    }

    public function setCustoDiretoAttribute($value)
    {
       $this->attributes['custo_direto'] = str_replace(',','.',str_replace('.',',',$value));
    }

    public function setCustoTotalAttribute($value)
    {
       $this->attributes['custo_total'] = str_replace(',','.',str_replace('.',',',$value));
    }

    public function setIssAliquotaAttribute($value)
    {
       $this->attributes['iss_aliquota'] = str_replace(',','.',str_replace('.',',',$value));
    }


    /**
     * get Attributes
     * Fields descricao to Upper
     *        valor to 0,00
     *        custo_direto to 0,00
     *        iss_aliquota  to 0,00
     *        custo_total to 0,00 
     */
    public function getValorAttribute($value)
    {
         return number_format($value,2,',','.');
    }

    public function getCustoDiretoAttribute($value)
    {
         return number_format($value,2,',','.');
    }

    public function getCustoTotalAttribute($value)
    {
         return number_format($value,2,',','.');
    }

    public function getIssAliquotaAttribute($value)
    {
         return number_format($value,3,',','.');
    }

}
