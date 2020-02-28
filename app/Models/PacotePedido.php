<?php

namespace AtitudeAgenda\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class PacotePedido extends Model
{
    use SoftDeletes;
    
    protected $connection = 'tenant';
    protected $table = 'pacotes_pedido';
    protected $primaryKey = 'id';
    protected $fillable = [
        'pedido_id',
        'pacote_id',
        'quantidade',
        'valor_unitario',
        'desconto_item',
        'valor_liquido_unitario',
        'valor_total_item',
        'observacao'
    ];

    public function pedido()
    {
        return $this->hasOne(Pedido::class, 'id', 'pedido_id');
    }

    public function pacote()
    {
        return $this->hasOne(Pacote::class, 'id', 'pacote_id');
    }

     public function detalhePedido()
    {
        return $this->hasMany(DetalhePedido::class, 'pacote_pedido_id', 'id');
    }

    public function pedidoPacote()
    {
       return $this->belongsToMany(Pacote::class,'pedido_id','pacote_id','id' );
    }

    public function pacoteServico()
    {
      return $this->hasOne(PacoteServico::class, 'pacote_id', 'pacote_id');
    }
    
    public function setValorUnitarioAttribute($value)
    {
       $this->attributes['valor_unitario'] = str_replace(',','.',str_replace('.',',',$value));
    }

    public function setDescontoItemAttribute($value)
    {
       $this->attributes['desconto_item'] = str_replace(',','.',str_replace('.',',',$value));
    }

    public function setValorLiquidoUnitarioAttribute($value)
    {
       $this->attributes['valor_liquido_unitario'] = str_replace(',','.',str_replace('.',',',$value));
    }

    public function setValortotalItemAttribute($value)
    {
       $this->attributes['valor_total_item'] = str_replace(',','.',str_replace('.',',',$value));
    }

    public function getValorUnitarioAttribute($value)
    {
      return number_format($value,2,',','.');
    
    }

    public function getDescontoItemAttribute($value)
    {
      return number_format($value,2,',','.');
    
    }

    public function getValorLiquidoUnitarioAttribute($value)
    {
      return number_format($value,2,',','.');
    
    }

    public function getValorTotalItemAttribute($value)
    {
      return number_format($value,2,',','.');
    
    }

   
    
}
