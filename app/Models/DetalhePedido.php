<?php

namespace AtitudeAgenda\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class DetalhePedido extends Model
{
    use SoftDeletes;

    protected $connection = 'tenant';
    protected $table = 'detalhe_pedido';
    protected $primaryKey = 'id';
    protected $fillable = [
        'pacote_pedido_id',
        'pacote_id',
        'qtde_adquirida',
        'qtde_consumida'
    ];

    public function pacotePedido()
    {
        return $this->hasOne(PacotePedido::class,
            'id', 
            'pacote_pedido_id'
        );
    }

    public function servico()
    {
        return $this->hasOne(Servico::class, 
            'id',  
            'servico_id'
        );
    }

    public function saldo()
    {
        $saldo =  $this->attributes['qtde_adquirida'] - $this->attributes['qtde_consumida'];
        return $saldo;
    }

}
