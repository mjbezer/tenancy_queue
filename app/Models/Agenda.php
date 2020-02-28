<?php

namespace AtitudeAgenda\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use AtitudeAgenda\User;

class Agenda extends Model
{
  use SoftDeletes;
  
    protected $connection = 'tenant';
    protected $table = 'agenda';
    protected $primaryKey = 'id';
    protected $fillable = [
      'id', 
      'inicio', 
      'fim', 
      'pedido_id', 
      'servico_id', 
      'status_agenda', 
      'status_financeiro',
      'observacao'
      ];
  
 
    
    public function pedido() 
    {
      return $this->hasOne(Pedido::class,
        'id',
        'pedido_id');
    }

    public function servico() 
    {
      return $this->hasOne(Servico::class,
        'id',
        'servico_id');
    }
  
    public function setFimAttribute($value)
    {
        $this->attributes['fim'] = date('Y-m-d H:i', strtotime(str_replace('/', '-',$value)));
    }

   
    static function verificaAgenda($servico_id, $inicio, $fim)
    {
      $data = date('Y-m-d', strtotime($inicio));
      if ($data<date('Y-m-d')){
          return $agendaLivre = false;
      }else{
          $inicio = date('d/m/Y H:i:s',strtotime($inicio));
          $fim = date('d/m/Y H:i:s',strtotime($fim));
          $agendas= Agenda::where('servico_id', $servico_id)
            ->where('inicio', 'like' , $data.'%')
            ->get();
            foreach($agendas as $agenda){
              if($inicio >= $agenda->inicio
                && $inicio <= $agenda->fim 
              ){
                $agendaLivre = 0;
              }
              if( $fim >= $agenda->inicio
              && $fim <= $agenda->fim
              ){
                $agendaLivre = 0;
              }
          }
        if(isset($agendaLivre)){
          return $agendaLivre = false;
        }else{
        return $agendaLivre = true;
        }
      }
    }

    static function dataHora($agenda)
    {
      echo  date( "Y-m-d H:i", strtotime( $agenda->inicio )).'<br>';
      echo $agenda->fim ;
      exit;
      return $agenda;

    }
}