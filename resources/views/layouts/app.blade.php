<!DOCTYPE html>
<html lang="pt-Br">
<head>
   @include('includes.headers')
   @stack('header')
</head>
<body class="fundo">
    <div class="fixed-top" style="background-color: #252d30">
    <nav class="navbar navbar-expand-lg">
                <a href="{{ route('dashboard') }}" class="navbar-brand t1 text-white">
                    <img src="{{ asset('imagens/logo_AA.png') }}" alt="Atitude Agenda" data-toggle="tooltip" title="Atitude Agenda, sua agenda com muito mais atitude. Clique para voltar ao início.">
                </a>
    
                <button class="navbar-toggler navbar-dark" data-toggle="collapse" data-target="#navbarMenu">
                    <span style="color : white"><span class="navbar-toggler-icon"></span></span>
                </button>
    
                <div class="navbar-collapse collapse justify-content-end" id="navbarMenu">
    
                    <div>
    
                        <ul class="navbar-nav mr-auto">
                            
                        <li class="nav-item ml-1">
                                <a class="nav-link nav-link rounded text-white bg-padrao pl-3 pr-3"
                                    href="{{ route('dashboard') }}"><i class="fa fa-home icone"></i>Início</a>
                            </li>
                            <li class="nav-item ml-1">
                                <a class="nav-link nav-link rounded text-white bg-padrao pl-3 pr-3"
                                    href="{{ route('agendas.index') }}"><i class="fa fa-calendar icone"></i>Agenda</a>
                            </li>
                           
    
                            <li class="nav-item dropdown ml-1">
                                <a class="nav-link dropdown-toggle rounded text-white bg-padrao pl-3 pr-3" href="#"
                                    id="navCadastro" role="button" data-toggle="dropdown" aria-haspopup="true"
                                    aria-expanded="false">
                                    <i class="fa fa-users icone"></i>Cadastros
                                </a>
                                <div class="dropdown-menu" aria-labelledby="navCadastro">
                                    <a class="dropdown-item" href="{{ route('pessoas.index') }}"><i class="fa fa-street-view icone"></i>Clientes / Fornecedores</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="{{ route('servicos.index') }}"><i class="fa fa-hand-peace-o icone"></i>Serviços</a>
                                    <a class="dropdown-item" href="{{ route('pacotes.index') }}"><i class="fa fa-gift icone"></i>Pacotes de Serviços</a>
                                </div>
                            </li>
                              
                            <li class="nav-item dropdown ml-1">
                                <a class="nav-link dropdown-toggle rounded text-white bg-padrao pl-3 pr-3" href="#"
                                    id="navFinanceiro" role="button" data-toggle="dropdown" aria-haspopup="true"
                                    aria-expanded="false">
                                    <i class="fa fa-line-chart icone"></i>Financeiro
                                </a>
                                <div class="dropdown-menu" aria-labelledby="navFinanceiro">
                                    <a class="dropdown-item" href="{{ route('contas-receber.index') }}"><i class="fa fa-money icone"></i>Contas a
                                        Receber</a>
                                    <a class="dropdown-item" href="{{ route('contas-pagar.index') }}"><i class="fa fa-credit-card icone"></i>Contas a
                                        Pagar</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="{{ route ('totalizador.index') }}"><i class="fa fa-object-group icone"></i>DRE</a>
    
                                    
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="{{ route('categorias.index') }}"><i class="fa fa-sitemap icone"></i>Categorias e Sub
                                        Categorias</a>
    
                                </div>
                            </li>
    
                            <li class="nav-item dropdown ml-1">
                                <a class="nav-link dropdown-toggle rounded text-white bg-padrao pl-3 pr-3" href="#"
                                    id="navUsuario" role="button" data-toggle="dropdown" aria-haspopup="true"
                                    aria-expanded="false">
                                    <i class="fa fa-user icone"></i><span
                            class="text-capitalize">{{ Auth::user()->name }}</span>
                                </a>
                                <div class="dropdown-menu" aria-labelledby="navUsuario">
                                    <a class="dropdown-item" href="{{ route('parametros.index') }}"><i class="fa fa-cogs icone"></i>Configurações</a>
    
                                    <a class="dropdown-item" href="{{ route('usuarios.index') }}"><i class="fa fa-user icone"></i>Usuários</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href=""><i class="fa fa-info-circle icone"></i>Minha
                                        Conta</a>
                                    <a class="dropdown-item" href="#"><i class="fa fa-tags icone"></i>Meus Tickets</a>
    
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="{{ route('faq.index') }}"><i class="fa fa-commenting-o icone"></i>FAQ e Dicas Importantes</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="{{ route('logoutApi')}}"><i class="fa fa-power-off icone"></i> Sair</a>
    
                                </div>
                            </li>
    
                        </ul>
    
                    </div>
                </div>
            </nav>
        <div class="container">
     
        </div>
    </div>

    @yield('content')
    
    <div class="fixed-bottom bg-dark">
            <div class="row">
                <div class="col-2 pt-1 pb-1">
                    <span class="text-verde">SoftWork &#174;</span>
                </div>
                <div class="col-8">
                        <span class="text-warning text-center" id="notificacao-email"></span>
                </div>
                <div class="col-2 text-right pt-1 pb-1">
                    <a href="https://api.whatsapp.com/send?phone=5511992335132" target="_blank">
                        <span class="text-verde"><i class="fa fa-whatsapp icone"></i>(11) 9 9233 5132</a>
                </div>
            </div>
    </div>
    
    <script type="text/javascript" src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/jquery-3.3.1.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/bootstrap.bundle.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/notify.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/jquery.mask.js') }}" ></script>
     
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>  
    
    <script type="text/javascript" src="{{ asset('DataTables/datatables.min.js') }}"></script> 
    <script type="text/javascript" src="{{ asset('DataTables/Buttons-1.5.6/js/buttons.bootstrap4.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('DataTables/Buttons-1.5.6/js/buttons.print.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('DataTables/Buttons-1.5.6/js/buttons.colVis.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('DataTables/Buttons-1.5.6/js/buttons.flash.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('DataTables/Buttons-1.5.6/js/buttons.html5.min.js') }}"></script>    
    <script type="text/javascript" src="{{ asset('DataTables/Responsive-2.2.2/js/responsive.bootstrap4.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('DataTables/AutoFill-2.3.3/js/autoFill.bootstrap4.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('DataTables/AutoFill-2.3.3/js/dataTables.autoFill.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('DataTables/Responsive-2.2.2/js/responsive.bootstrap4.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('DataTables/Responsive-2.2.2/js/dataTables.responsive.min.js') }}"></script>    
    <script type="text/javascript" src="{{ asset('DataTables/ColReorder-1.5.0/js/dataTables.colReorder.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('DataTables/FixedColumns-3.2.5/js/dataTables.fixedColumns.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('DataTables/FixedHeader-3.1.4/js/dataTables.fixedHeader.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('DataTables/KeyTable-2.5.0/js/dataTables.keyTable.min.js') }}"></script>    
    <script type="text/javascript" src="{{ asset('DataTables/RowGroup-1.1.0/js/dataTables.rowGroup.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('DataTables/Scroller-2.0.0/js/dataTables.scroller.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('DataTables/Select-1.3.0/js/dataTables.select.min.js') }}"></script>
    <script src="{{('src/notificacoes/gets.js')}}"></script>
     
    <script type="text/javascript">
        $(function () {
            $('[data-toggle="tooltip"]').tooltip()
        })
    </script>

    @yield('pagejs')

    @stack('importJs')

    @stack('scriptJs')


</body>
</html>


