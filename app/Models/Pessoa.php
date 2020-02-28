<?php

namespace AtitudeAgenda\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use AtitudeAgenda\Http\Controller\ParametroController;
use AtitudeAgenda\User;


class Pessoa extends Model
{
  use SoftDeletes;

    protected $connection = 'tenant';
    protected $table = 'pessoas';
    protected $primaryKey = 'id';
    protected $fillable = [
      'nome_razao_social',
      'nome_usual_fantasia',
      'cpf_cnpj',
      'rg_ie',
      'data_nascimento_abertura',
      'cep',
      'logradouro',
      'numero',
      'complemento',
      'bairro',
      'cidade',
      'codigo_municipio',
      'uf',
      'telefone',
      'celular',
      'email',
      'tipo_cliente',
      'tipo_fornecedor',
      'ativo'
    ];
    
    public function pedidos()
    {
        return $this->hasMany(Pedido::class, 'pessoa_id', 'id');
    }

    public function agendas()
    {
        return $this->hasMany(Agenda::class, 'pessoa_id', 'id');
    }

    public function licenciado()
    {
        return $this->hasOne(User::class, 'licenciado_id', 'licenciado_id');
    }

    /**
     * Set Attributes
     * Fields nome_razao_social to Upper
     *        nome_usual_fantasia to Upper
     *        logradouro to Upper
     *        complemento to Upper
     */
   
    public function setNomeRazaoSocialAttribute($value)
    {
        $this->attributes['nome_razao_social'] =  $value;
    }

    public function setNomeUsualFantasiaAttribute($value)
    {
        $this->attributes['nome_usual_fantasia'] = $value;
    }

    public function setLogradouroAttribute($value)
    {
        $this->attributes['logradouro'] = $value;
    }

    public function setComplementoAttribute($value)
    {
        $this->attributes['complemento'] = $value ;
    }

     /**
     * get Attributes
     * Fields data_nascimento_abertura to dd/mm/aaaa format
     *     
     */

   
    public function getNomeRazaoSocialAttribute($value)
    {
        return $value ;
    }

    public function getNomeUsualFantasiaAttribute($value)
    {
        return $value;
    }
    

    
}