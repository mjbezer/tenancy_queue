<?php

namespace AtitudeAgenda\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class PacoteServico extends Model
{
    use SoftDeletes;

    protected $connection = 'tenant';
    protected $table = 'pacotes_servicos';
    protected $primaryKey = 'id';
    protected $fillable = [
        'pacote_id',
        'servico_id',
        'quantidade',
        'valor_unitario',
        'desconto_real',
        'valor_servico',
    ];

    public function pacote()
    {
        return $this->hasOne(Pacote::class,'id','pacote_id');
    }

    public function servico()
    {
        return $this->hasOne(Servico::class,'id','servico_id');
    }

     /**
     * Sets Attributes
     * @insert to database the attribute value
     */

    public function setValorUnitarioAttribute($value)
    {
       $this->attributes['valor_unitario'] = str_replace(',','.',str_replace('.',',',$value));
    }

    public function setDescontoRealAttribute($value)
    {
       $this->attributes['desconto_real'] = str_replace(',','.',str_replace('.',',',$value));
    }

    public function setValorServicoAttribute($value)
    {
       $this->attributes['valor_servico'] = str_replace(',','.',str_replace('.',',',$value));
    }

     /**
     * Gets Attributes
     * @return to database the attribute value
     */

    public function getValorUnitarioAttribute($value)
    {
      return number_format($value,2,',','.');
    }

    public function getDescontoRealAttribute($value)
    {
      return number_format($value,2,',','.');
    }

    public function getValorServicoAttribute($value)
    {
      return number_format($value,2,',','.');
    }

    /**
     * Retorna pacote caso padrão 1 - Serviço avulso 
     * 
     */
    static function servicoPacote($servico_id)
    {
      $pacoteServicos = PacoteServico::where('servico_id',$servico_id)->get();
      foreach ($pacoteServicos as $pacoteServico ){
        if ($pacoteServico->pacote->padrao == 1){
          $value = $pacoteServico->pacote;
          return $value;
        }
        }
    }
    
    
}
