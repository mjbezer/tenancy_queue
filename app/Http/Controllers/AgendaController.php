<?php

namespace AtitudeAgenda\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use AtitudeAgenda\Http\Requests\AgendaRequest;
use AtitudeAgenda\Models\Agenda;
use AtitudeAgenda\Models\PacoteServico;
use AtitudeAgenda\Models\EmailConfig;
use AtitudeAgenda\Models\Pessoa;
use AtitudeAgenda\Models\Pedido;
use AtitudeAgenda\Http\Controllers\FormaRecebimentoController;
use AtitudeAgenda\Http\Controllers\PedidoController;
use AtitudeAgenda\Http\Controllers\DetalhePedidoController;
use AtitudeAgenda\Http\Controllers\ContasReceberController;

use Illuminate\Support\Facades\Mail;
use AtitudeAgenda\Jobs\SendAgendaEmail;
use AtitudeAgenda\Jobs\SendReagendamentoEmail;
use AtitudeAgenda\Jobs\SendCancelamentoAgendaEmail;

class AgendaController extends Controller
{
       
    public function index()
    {
        $agendas = Agenda::where('status_agenda', 1)
                        ->get();
        return view('agenda.index',['agendas' => $agendas]);
    }

    public function create()
    {
        return view('agenda.create');
    }

     public function store(Request $request)
    {
        $verifica = Agenda::verificaAgenda(
                                $request->servico_id, 
                                $request->inicio,
                                $request->fim
                            );
           if($verifica){
            $request = $request->all();
            if (isset($request['forma_recebimento_id'])){
                        $pacote = PacoteServico::servicoPacote($request['servico_id']);
        
                $pedido = [
                    'pessoa_id'=> $request['pessoa_id'],
                    'data_pedido'=> date('Y-m-d'),
                    'valor' => $request['valor'],
                    'desconto' => $request['desconto'],
                    'valor_total'=> $request['valor_total'],
                    'forma_recebimento_id' => $request['forma_recebimento_id'],
                    'pacote_id' => $pacote->id,
                    'quantidade' => 1,
                    'valor_unitario' => $request['valor'],
                    'desconto_item' =>$request['desconto'],
                    'valor_liquido_unitario' => $request['valor_total'],
                    'valor_total_item' => $request['valor_total'],
                    'observacao' =>  $request['observacao'],
                    'data_vencimento'=> $request['data_vencimento'],
                    
                    ];

                $insertPedido = PedidoController::storeBySchedule($pedido);
                $agenda = [
                    'inicio'=> $request['inicio'],
                    'fim' =>$request['fim'],
                    'obervacao' =>$request['observacao'],
                    'pedido_id' => $insertPedido->id,
                    'servico_id'=>$request['servico_id'],
                    'status_financeiro'=>0
                    ] ;
                $insertAgenda = Agenda::create($agenda);
                $pessoaSearch = Pessoa::find($request['pessoa_id']);
                $config = EmailConfig::emailConfig();
                if(isset($config)){
                    
                    $pagamento = FormaRecebimentoController::caschInMessage($request['forma_recebimento_id']);
                    $remetente = EmailConfig::first();
                                SendAgendaEmail::dispatch($pessoaSearch->email,
                                              $insertPedido,
                                              $insertAgenda,
                                              $remetente->from_name,
                                              $pagamento
                                             );
                }

            }else{
                $request['status_financeiro'] = 1;
                  
                $insertAgenda = Agenda::create($request);
                        $debitaSaldo = DetalhePedidoController::debitBalance($request['detalhe_pedido_id']);
                        $pedidoSearch = Pedido::find($debitaSaldo->pacotePedido->pedido_id);
                $pessoaSearch = Pessoa::find($request['pessoa_id']);
                $config = EmailConfig::emailConfig();
                        if(isset($config)){
                    $pagamento = FormaRecebimentoController::caschInMessage($pedidoSearch->forma_recebimento_id);
                    $remetente = EmailConfig::first();
                    SendAgendaEmail::dispatch($pessoaSearch->email,
                                                     $pedidoSearch, 
                                                     $insertAgenda,
                                                     $remetente->from_name,
                                                     $pagamento
                                                    );
                    }
            }
            return redirect()->back();
        }else{
            return redirect()->back()->with('message', 
            "Data e hora selecionada não esta disponível ou data selecionada é anterior a data atual, selecione outro data e horário");
        }
    }

           
    public function edit($id, $pessoa='')
    {
        $agenda  = Agenda::find($id); 
        $pesquisa = Agenda::where('status_agenda', 1)
                        ->get();

        return view('agenda.edit',[
            'agenda'=>$agenda, 
            'pessoa'=>$pessoa,
            'pesquisa' => $pesquisa
            ]);
    }

  
    public function update(Request $request, $id)
    {
        $verifica = Agenda::verificaAgenda(
            $request->servico_id, 
            $request->inicio,
            $request->fim
        );

        if($verifica){
            $request= $request->all();
                $updateAgenda = Agenda::find($id); 
            $updateAgenda->update($request);
            $config = EmailConfig::emailConfig();
                if(isset($config)){
                        $remetente = EmailConfig::first();
                $pedidoSearch = Pedido::find($updateAgenda->pedido_id);
                $config = EmailConfig::emailConfig();
                        SendReagendamentoEmail::dispatch($updateAgenda->pedido->pessoa->email,
                                            $pedidoSearch, 
                                            $updateAgenda,
                                            $remetente->from_name
                                            );
            }
            if(isset($request['pessoa'])){
                return redirect()->route('pessoas.show', $request['pessoa']);
            }else{
                return redirect()->route('agendas.index');
            }
        }else{
            return redirect()->back()->with('message', 
            "Data e hora selecionada não esta disponível ou data selecionada é anterior a data atual, selecione outro data e horário");
        }
    }

   
    public function destroy($id)
    {
        $deleteAgenda = Agenda::find($id);
        $email = $deleteAgenda->pedido->pessoa->email;
        $config = EmailConfig::emailConfig();

        if(isset($config)){
                $remetente = EmailConfig::first();
            $pedidoSearch = Pedido::find($deleteAgenda->pedido_id);
    
            SendCancelamentoAgendaEmail::dispatch($email,
                                            $pedidoSearch, 
                                            $deleteAgenda,
                                            $remetente->from_name
                                        );
                }
        PedidoController::cancellation($deleteAgenda);
        $deleteAgenda->delete();
        if($deleteAgenda){
            $msg = '200';
        }else{
            $msg = '500';
        }
        return $msg;    
    }

    public function atendimento($id)
    {
        $atendimentoAgenda = Agenda::find($id);
        $atendimentoAgenda->status_agenda = 0;
        $atendimentoAgenda->save();   
        return redirect()->route('agendas.index');
    }
 
    public function resendMail($id)
    {
        $agenda = Agenda::find($id);
        $config = EmailConfig::emailConfig();
        if($config){
            SendAgendaEmail::dispatch($agenda->pedido->pessoa->email,
                                      $agenda->pedido,
                                      $agenda
           );
     
        }
        return redirect()->route('agendas.index');
    }

    /**
     * Request Ajax methods
     * */
    public function getById($id)
    {
        $inicio = Agenda::find($id)->getOriginal('inicio');
        $agenda = Agenda::where('id',$id)
                ->with(['pedido.pessoa', 'servico'])
                ->get();
        $agenda['ini'] = date('Y-m-d\Th:i', strtotime($inicio));
        
        return json_encode($agenda);
    }

    public function agenda(){
        $agenda = Agenda::where('status_agenda', 1)->get();
        return json_encode($agenda);

    }

    public function verifySchedule($inicio, $fim)
    {   
        $agendas = Agenda::whereBetween('inicio', [$inicio, $fim])
                            ->where('status_agenda','<', 2)
                            ->get();
        return json_encode($agendas);
    }

    public function storeDateBlocked(Request $request){
        Agenda::create($request->all());
        return redirect()->route('agendas.index');
    }

    public function updateDateBlocked(Request $request, $id)
    {
        $request = $request->all();
        $agenda = Agenda::find($id);
        $agenda->update($request);
        return redirect()->route('agendas.index');
    }

    public function deleteDateBlocked($id)
    {
        $deletaBloqueio = Agenda::find($id);
        $deletaBloqueio->delete();
        if($deletaBloqueio){
            $msg = '200';
        }else{
            $msg = '500';
        }
        return $msg;   
    }
}