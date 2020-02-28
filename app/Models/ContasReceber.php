<?php

namespace AtitudeAgenda\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use AtitudeAgenda\User;

class ContasReceber extends Model
{
    use SoftDeletes;
    protected $table = 'contas_receber';
    protected $primaryKey = 'id';
    protected $fillable = [
      'id',
      'pedido_id',
      'pessoas_id', 
      'data_vencimento',
      'valor_original',
      'data_pagamento',
      'desconto',
      'valor_pago',
      'observacao',
      'licenciado_id'
    ];

    public $preventAttrSet = true;

    public function licenciado()
    {
       return $this->hasOne(User::class, 'licenciado_id', 'licenciado_id');
    }

    public function pedido() 
    {
      return $this->hasOne(Pedido::class, 'id', 'pedido_id');
    }

    public function pessoa() 
    {
      return $this->hasOne(Pessoa::class, 'id', 'pessoa_id');
    }

    public function formaRecebimento()
    {
      return $this->hasOne(FormaRecebimento::class, 'id', 'forma_recebimento_id');
    }

    public function pacotePedido()
    {
       return $this->hasOne(PacotePedido::class, 'pedido_id', 'pedido_id');
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

    public function setValorOriginalAttribute($value)
    {
      if ($this->preventAttrSet) {
        $this->attributes['valor_original'] = $value;
      } else {
        $this->attributes['valor_original'] = str_replace(',','.',str_replace('.','',$value));

      }
    }

    public function setDescontoAttribute($value)
    {
        $this->attributes['desconto'] = str_replace(',','.',str_replace('.','',$value));
    }

    public function setValorPagoAttribute($value)
    {
      if ($this->preventAttrSet) {
        $this->attributes['valor_pago'] = $value;
      } else {
        $this->attributes['valor_pago'] = str_replace(',','.',str_replace('.','',$value));
      }
    }

    
    public function getTotalPorRecebimentoAttribute($value)
    {
      return number_format($value,2, ',', '.');

    }

    static function sumToReceive($data_inicio, $data_fim)
    {
      return ContasReceber::whereBetween('data_vencimento', [$data_inicio, $data_fim])
                          ->where('data_pagamento', null)
                          ->selectRaw('SUM(valor_pago) as totalReceber')
                          ->groupBy('data_pagamento')
                          ->get();
    }


    static function getFormaRecebimento()
    {
      $formaRecebimento = FormaRecebimento::all();
      return $formaRecebimento;
    }

 


  
}