<?php
/**
 * Rotas de Landing Page 
 * 
 */

Route::get('/', 'IndexController@index')->name('home');
Route::post('/cadastro-local/{contrato_id}','IndexController@cadastroLocal');
Route::get('/cadastro', 'IndexController@cadastro')->name('cadastro');
Route::get('/pagamento/{id}', 'IndexController@pagamento');
Route::get('/contrato/{id}/{status}', 'IndexController@endpage');
Route::post('/loginApi', 'AuthController@login')->name('loginApi');
Route::get('logoutApi', 'AuthController@logout')->name('logoutApi');
Route::get('/pacote/{id}', 'PacoteController@getForCategory');
Route::get('/contratos/validacao/{contrato_id}/{user_id}', 'IndexController@validateContract');
Route::get('/parametros/validacao/{contrato_id}', 'ParametroController@workspaceConfig');

Auth::routes(['verify'=>true]);

 /**
 * Rotas para usuários autenticados 
 * 
 */

Route::group(['middleware' => 'auth'], function () {


    /**
     * Rotas de Dashboard
     */
     Route::get('/dashboard/agendas', 'DashboardController@agendas');
     Route::get('/dashboard', 'DashboardController@index')->name('dashboard');


    /**
     *  Rotas de Pessoas
     */
    Route::get('/pessoas/{id}/destroy', 'PessoaController@destroy');
    Route::get('/pessoas/indexTable', 'PessoaController@indexTable');
    Route::get('/pessoas/getAll/{tipo}', 'PessoaController@getAll');
    Route::get('/pessoas/show/{id}', 'PessoaController@show');
    Route::resource('pessoas', 'PessoaController');

    /**
     *  Rotas de Categorias
     */
    Route::get('/categorias/{id}/destroy', 'CategoriaController@destroy');
    Route::get('/categorias/getAll','CategoriaController@getAll');
    Route::resource('categorias', 'CategoriaController');

    /**
     *  Rotas de Sub - Categorias
     */
    Route::get('/sub_categorias/getByCategory/{id}','SubCategoriaController@getByCategory');
    Route::get('/subcategorias/{id}/destroy','SubCategoriaController@destroy');
    Route::resource('subcategorias', 'SubCategoriaController');

    /**
     *  Rotas de Serviços
     */
    Route::get('/servicos/{id}/destroy', 'ServicoController@destroy');
    Route::get('/servicos/getAll', 'ServicoController@getAll');
    Route::get ('/servicos/getById/{id}', 'ServicoController@getById');
    Route::resource('servicos', 'ServicoController');

    /**
     *  Rotas de Pacotes
     */
    Route::get('/pacotes/{id}/destroy', 'PacoteController@destroy');
    Route::get('/pacotes/getAll','PacoteController@getAll');
    Route::get('/pacotes/getById/{id}','PacoteController@getById');
    Route::resource('pacotes', 'PacoteController');



    /**
     *  Rotas de Pedidos
     */
    
    Route::get('/pedidos/getByPessoa/{pessoa}/{servico}', 'PedidoController@getByPessoa');
    Route::put('/pedidos/{id}/cancelar', 'PedidoController@cancellation');
    Route::get('/pedidos/sendmail/{id}', 'PedidoController@sendEmail');
    Route::get('/pedidos/create/{id}','PedidoController@create');
    Route::resource('pedidos', 'PedidoController');
    Route::resource('pacote_pedido', 'PacotePedidoController');
    Route::resource('detalhe_pedido', 'DetalhePedidoController');

    /**
     *  Rotas de Forma de Recebimento
     */

    Route::get('/recebimentos/getByStatus', 'FormaRecebimentoController@getByStatus');
    Route::post('/recebimentos/formConfig', 'FormaRecebimentoController@formConfig')->name('recebimentos.formConfig');

    Route::resource('recebimentos', 'FormaRecebimentoController');


    /**
     *  Rotas Minha Conta
     * 
     */
    Route::get('get-user','MinhacontaController@getUser');
    Route::post('parametros/salva-trf', 'ParametroController@salvaTrf')->name('parametros.salvaTrf');    

    Route::get('parametros', ['as'=>'parametros.index','uses'=>'\AtitudeAgenda\Http\Controllers\ParametroController@index']);
    
    Route::get('faq', 'FaqController@index')->name('faq.index');
    
    Route::post ('/email_config/store', 'EmailConfigController@store')->name('email_config.store');
    Route::put ('/email_config/update/{id}', 'EmailConfigController@update')->name('email_config.update');
    Route::resource('/minhaconta','MinhacontaController');

    /**
     * Rotas de Agenda
     */
    Route::get('/agenda','AgendaController@agenda'); 
    Route::get('/agenda/edit/{id}','AgendaController@edit');
    Route::get('/agenda/resendmail/{id}','AgendaController@resendMail')->name('agenda.resendmail');
    Route::get('/agendas/atendimento/{id}', 'AgendaController@atendimento')->name('agendas.atendimento');
    Route::get('/agendas/{id}/destroy', 'AgendaController@destroy');
    Route::get('/agendas/bloqueio/{inicio}/{fim}', 'AgendaController@verifySchedule');
    Route::post('/agendas/bloquear', 'AgendaController@storeDateBlocked');
    Route::put('/agendas/update-bloqueio/{id}', 'AgendaController@updateDateBlocked')->name('agendas.updateBlocked');
    Route::get('/agendas/delete-bloqueio/{id}', 'AgendaController@deleteDateBlocked');
    
    Route::resource('agendas', 'AgendaController');

    /**
     *  Rotas Contas Receber
     */
    Route::get('/contas-receber/fastConsolidation/{id}', 'ContasReceberController@fastConsolidation');
    Route::resource('contas-receber', 'ContasReceberController');


    /**
     *  Rotas Contas Pagar
     * 
     */
    Route::get('/contas-pagar/fastConsolidation/{id}', 'ContasPagarController@fastConsolidation');
    Route::get('/contas-pagar/{id}/destroy', 'ContasPagarController@destroy');
    Route::resource('contas-pagar', 'ContasPagarController');

     /**
     * Rotas Totalizador
     *
     */
    Route::get('/totalizador-extrato-categorias/{mes}/{ano}', 'TotalizadorController@extratoCategorias')->name('totalizador.extrato.categorias');
    Route::get('/totalizador', 'TotalizadorController@index')->name('totalizador.index');
    

    /** Route::resource('fornecedores', 'FornecedorController'); */    
    Route::resource('pacotes', 'PacoteController');
    Route::resource('tickets', 'TicketController'); 
   
    
    /**Route::resource('depositoconfig', 'DepositoConfigController');*/
    Route::get('/email/getByLicensed', 'EmailConfigController@getByLicensed');
    Route::resource('emailconfig', 'EmailConfigController');

    /* Rotas User */
    Route::resource('/users', 'UsersController')->middleware(['auth']) ;
    Route::get('/users/removefoto/{id}', 'UsersController@removefoto')->name('user.removefoto');
  });



