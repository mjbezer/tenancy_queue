<?php

namespace AtitudeAgenda\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use AtitudeAgenda\User;

class Pedido extends Model
{
    use SoftDeletes;

    protected $connection = 'tenant';
    protected $table = 'pedidos';
    protected $primaryKey = 'id';
    protected $fillable = [
      'id',
      'pessoa_id',
      'data_pedido',
      'valor',
      'desconto',
      'valor_total',
      'observacao',
      'forma_recebimento_id',
      'licenciado_id'
    ];

    public function licenciado()
    {
      return $this->hasOne(User::class, 'licenciado_id', 'licenciado_id');
    }

    public function agendas()
    {
      return $this->hasMany(Agenda::class,
      'pedido_id',
      'id');
    }

    public function pessoa()
    {
      return $this->hasOne(Pessoa::class,
        'id',
        'pessoa_id');
    }

    public function pacotePedido() 
    {
      return $this->hasMany(PacotePedido::class,
        'pedido_id',
        'id');
    }
    
    public function contaReceber()
    {
      return $this->hasOne(ContasReceber::class, 'pedido_id', 'id');
    }

    
    public function formaRecebimento()
    {
      return $this->hasOne(FormaRecebimento::class, 'id', 'forma_recebimento_id');
    }

     /**
     * Sets Attributes
     * @insert to database the attribute value
     */

    public function setValorAttribute($value)
    {
       $this->attributes['valor'] = str_replace(',','.',str_replace('.',',',$value));
    }

    public function setDescontoAttribute($value)
    {
       $this->attributes['desconto'] = str_replace(',','.',str_replace('.',',',$value));
    }

    public function setValorTotalAttribute($value)
    {
       $this->attributes['valor_total'] = str_replace(',','.',str_replace('.',',',$value));
    }

     /**
     * Gets Attributes
     * @return to database the attribute value
     */

    public function getValorAttribute($value)
    {
      return number_format($value,2,',','.');
    }

    public function getDescontoAttribute($value)
    {
      return number_format($value,2,',','.');
    }

    public function getValorTotalAttribute($value)
    {
      return number_format($value,2,',','.');
    }

    public function getDataPedidoAttribute($value)
    {
        return date('d/m/Y', strtotime($value));
    }
}