<?php

namespace AtitudeAgenda\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use AtitudeAgenda\User;

class ContasPagar extends Model
{
    use SoftDeletes;  

    protected $connection = 'tenant';
    protected $table = 'contas_pagar';
    protected $primaryKey = 'id';
    protected $fillable = [
      'pessoa_id',
      'descricao',
      'documento_fiscal',
      'data_documento_fiscal',
      'valor_original',
      'especie',
      'data_vencimento',
      'data_pagamento',
      'valor_pago',
      'observacao',
      'categoria_id',
      'licenciado_id',
      'sub_categoria_id'
    ];

    public $preventAttrSet = true;


    public function licenciado()
    {
      return $this->hasOne(User::class, 'licenciado_id', 'licenciado_id');
    }

    public function pessoa() {
      return $this->hasOne(Pessoa::class,
        'id',
        'pessoa_id');
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
   
}