<!doctype html>
<html lang="{{ config('app.locale') }}" class="no-focus">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">

    <title>AtitudeAgenda @yield('title')</title>

    <meta name="description" content="Atitude Agenda - Um software da SoftWork Comércio e Serviços de Informática Ltda">
    <meta name="author" content="SoftWork Comércio e Serviços de Informática Ltda">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Favicon icon -->
    <link rel="shortcut icon" href="{{ mix('images/favicon.ico') }}" type="image/x-icon">
    <link rel="icon" href="{{ mix('images/favicon.ico') }}" type="image/x-icon">

    <!-- Fonts and Styles -->
    @yield('css_before')

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Muli:300,400,400i,600,700">
    <link rel="stylesheet" id="css-main" href="{{ mix('app/css/app.css') }}">

    @yield('css_after')

    <!-- Scripts -->
    {{-- <script>
        window.Laravel = {
            !!json_encode(['csrfToken' => csrf_token(), ]) !!
        };

    </script> --}}

</head>

<body class="bg-gray">
    <div id="page-container"
        class="sidebar-o enable-page-overlay side-scroll page-header-modern page-header-fixed enable-cookies">
        <!-- Side Overlay-->
        <aside id="side-overlay">
            <!-- Side Header -->
            <div class="content-header content-header-fullrow">
                <div class="content-header-section align-parent">
                    <!-- Close Side Overlay -->
                    <!-- Layout API, functionality initialized in Template._uiApiLayout() -->
                    <button type="button" class="btn btn-circle btn-dual-secondary align-v-r" data-toggle="layout"
                        data-action="side_overlay_close">
                        <i class="fa fa-times text-danger"></i>
                    </button>
                    <!-- END Close Side Overlay -->

                    <!-- User Info -->
                    <div class="content-header-item">
                        <a class="img-link mr-5" href="javascript:void(0)">
                            <img class="img-avatar img-avatar32" src="{{ asset(Auth::user()->imagem) }}"
                                alt="{{ Auth::user()->name }}">
                        </a>
                        <a class="align-middle link-effect text-primary-dark font-w600"
                            href="javascript:void(0)">{{ Auth::user()->name }}</a>
                    </div>
                    <!-- END User Info -->
                </div>
            </div>
            <!-- END Side Header -->

            <!-- Side Content -->
            <div class="content-side">
                <p>
                    Usar para Suporte ( Tickets ) ...
                </p>
            </div>
            <!-- END Side Content -->
        </aside>
        <!-- END Side Overlay -->

        <!-- Sidebar -->
        <!--
                Helper classes

                Adding .sidebar-mini-hide to an element will make it invisible (opacity: 0) when the sidebar is in mini mode
                Adding .sidebar-mini-show to an element will make it visible (opacity: 1) when the sidebar is in mini mode
                    If you would like to disable the transition, just add the .sidebar-mini-notrans along with one of the previous 2 classes

                Adding .sidebar-mini-hidden to an element will hide it when the sidebar is in mini mode
                Adding .sidebar-mini-visible to an element will show it only when the sidebar is in mini mode
                    - use .sidebar-mini-visible-b if you would like to be a block when visible (display: block)
            -->
        <nav id="sidebar">
            <!-- Sidebar Content -->
            <div class="sidebar-content">
                <!-- Side Header -->
                <div class="content-header content-header-fullrow px-15">
                    <!-- Mini Mode -->
                    <div class="content-header-section sidebar-mini-visible-b">
                        <!-- Logo -->
                        <span class="content-header-item font-w700 font-size-xl float-left animated fadeIn">
                            <span class="text-dual-primary-dark">c</span><span class="text-primary">b</span>
                        </span>
                        <!-- END Logo -->
                    </div>
                    <!-- END Mini Mode -->

                    <!-- Normal Mode -->
                    <div class="content-header-section text-center align-parent sidebar-mini-hidden">
                        <!-- Close Sidebar, Visible only on mobile screens -->
                        <!-- Layout API, functionality initialized in Template._uiApiLayout() -->
                        <button type="button" class="btn btn-circle btn-dual-secondary d-lg-none align-v-r"
                            data-toggle="layout" data-action="sidebar_close">
                            <i class="fa fa-times text-danger"></i>
                        </button>
                        <!-- END Close Sidebar -->

                        <!-- Logo -->
                        <div class="content-header-item">
                            <a class="font-w700" href="{{ route('dashboard') }}">
                                <i class="si si-fi.re text-primary"></i>
                                <img src="{{ asset('imagens/logoSF_horiz.png') }}" class="img-fluid"
                                    alt="Atitude Agenda">
                            </a>
                        </div>
                        <!-- END Logo -->
                    </div>
                    <!-- END Normal Mode -->
                </div>
                <!-- END Side Header -->

                <!-- Side User -->
                <div class="content-side content-side-full content-side-user px-10 align-parent mt-20">
                    <!-- Visible only in mini mode -->
                    <div class="sidebar-mini-visible-b align-v animated fadeIn">
                        <img data-target="#novaFoto" data-toggle="modal" class="img-avatar img-avatar64"
                            src="{{ asset(Auth::user()->imagem) }}" alt="">
                    </div>
                    <!-- END Visible only in mini mode -->

                    <!-- Visible only in normal mode -->
                    <div class="sidebar-mini-hidden-b text-center">
                        <a class="img-link" data-target="#novaFoto" data-toggle="modal">

                            @if (Auth::user()->imagem)
                            <img class="img-avatar img-avatar64" src="{{ asset(Auth::user()->imagem) }}" alt="">
                            @else
                            <img class="img-avatar img-avatar64" src="media\avatars\avatar15.jpg" alt="">
                            @endif

                        </a>

                        <ul class="list-inline mt-10">
                            <li class="list-inline-item">
                                <a class="link-effect text-dual-primary-dark font-size-xs font-w600"
                                    href="{{ route('minhaconta.index') }}">{{ Auth::user()->name }}</a>
                            </li>
                        </ul>
                    </div>
                    <!-- END Visible only in normal mode -->
                </div>
                <!-- END Side User -->

                <!-- Side Navigation -->
                <div class="content-side content-side-full">
                    <ul class="nav-main">
                        <li>
                            <a class="{{ request()->is('dashboard') ? ' active' : '' }}"
                                href="{{ route('dashboard') }}">
                                <i class="si si-cup"></i><span class="sidebar-mini-hide">Dashboard</span>
                            </a>
                        </li>

                        <li>
                            <a class="{{ request()->is('agendas') ? ' active' : '' }}"
                                href="{{ route('agendas.index') }}">
                                <i class="si si-calendar"></i><span class="sidebar-mini-hide">Agenda</span>
                            </a>
                        </li>

                        <li class="{{ 
                                request()->is('pessoas')  || request()->is('pessoas/*') ||
                                request()->is('servicos') || request()->is('servicos/*') ||
                                request()->is('pacotes')  || request()->is('pacotes/*') ? ' open' : '' }}">
                            <a class="nav-submenu" data-toggle="nav-submenu" href="#"><i
                                    class="si si-folder-alt"></i><span class="sidebar-mini-hide">Cadastros</span></a>
                            <ul>
                                <li>
                                    <a class="{{ request()->is('pessoas') || request()->is('pessoas/*') ? ' active' : '' }}"
                                        href="{{ route('pessoas.index') }}">Clientes e Fornecedores</a>
                                </li>
                                <li>
                                    <a class="{{ request()->is('servicos') || request()->is('servicos/*') ? ' active' : '' }}"
                                        href="{{ route("servicos.index") }}">Serviços</a>
                                </li>
                                <li>
                                    <a class="{{ request()->is('pacotes') || request()->is('pacotes/*') ? ' active' : '' }}"
                                        href="{{ route('pacotes.index') }}">Pacote de Serviços</a>
                                </li>
                            </ul>
                        </li>

                        <li class="{{ 
                                request()->is('contas-receber') || request()->is('contas-receber/*') || 
                                request()->is('contas-pagar')   || request()->is('contas-pagar/*')   ||
                                request()->is('categorias')     || request()->is('categorias/*')     || request()->is('subcategorias/*') ||
                                request()->is('totalizador')
                                 ? ' open' : '' }}">
                            <a class="nav-submenu" data-toggle="nav-submenu" href="#"><i class="si si-wallet"></i><span
                                    class="sidebar-mini-hide">Financeiro</span></a>
                            <ul>
                                <li>
                                    <a class="{{ request()->is('contas-receber') ||request()->is('contas-receber/*') ? ' active' : '' }}"
                                        href="{{ route('contas-receber.index') }}">Contas a Receber</a>
                                </li>
                                <li>
                                    <a class="{{ request()->is('contas-pagar') ||request()->is('contas-pagar/*') ? ' active' : '' }}"
                                        href="{{ route('contas-pagar.index') }}">Contas a Pagar</a>
                                </li>
                                <li>
                                    <a class="{{ request()->is('totalizador') ? ' active' : '' }}"
                                        href="{{ route('totalizador.index') }}">DRE - Demonstrativo de Resultados</a>
                                </li>

                                <li>
                                    <a class="{{ request()->is('categorias') || request()->is('categorias/*') || request()->is('subcategorias/*') ? ' active' : '' }}"
                                        href="{{ route('categorias.index') }}">Categorias e SubCategorias</a>
                                </li>
                            </ul>
                        </li>

                        <li>
                            <a class="{{ request()->is('sair') ? ' active' : '' }}" href="{{ route('logoutApi') }}">
                                <i class="si si-logout"></i><span class="sidebar-mini-hide">Sair</span>
                            </a>
                        </li>

                    </ul>
                </div>
                <!-- END Side Navigation -->



            </div>
            <!-- Sidebar Content -->

        </nav>
        <!-- END Sidebar -->

        <!-- Header -->
        <header id="page-header">
            <!-- Header Content -->
            <div class="content-header">
                <!-- Left Section -->
                <div class="content-header-section">
                    <!-- Toggle Sidebar -->
                    <!-- Layout API, functionality initialized in Template._uiApiLayout() -->
                    <button type="button" class="btn btn-circle btn-dual-secondary" data-toggle="layout"
                        data-action="sidebar_toggle">
                        <i class="fa fa-navicon"></i>
                    </button>
                    <!-- END Toggle Sidebar -->

                    <!-- Open Search Section -->
                    <!-- Layout API, functionality initialized in Template._uiApiLayout() -->

                    <!-- END Open Search Section -->

                    <!-- Layout Options (used just for demonstration) -->
                    <!-- Layout API, functionality initialized in Template._uiApiLayout() -->
                    <div class="btn-group" role="group">
                        <button type="button" class="btn btn-circle btn-dual-secondary"
                            id="page-header-options-dropdown" data-toggle="dropdown" aria-haspopup="true"
                            aria-expanded="false">
                            <i class="fa fa-wrench"></i>
                        </button>
                        <div class="dropdown-menu min-width-300" aria-labelledby="page-header-options-dropdown">
                            <h5 class="h6 text-center py-10 mb-10 border-b text-uppercase">Settings</h5>
                            <h6 class="dropdown-header">Color Themes</h6>
                            <div class="row no-gutters text-center mb-5">
                                <div class="col-2 mb-5">
                                    <a class="text-default" data-toggle="theme" data-theme="default"
                                        href="javascript:void(0)">
                                        <i class="fa fa-2x fa-circle"></i>
                                    </a>
                                </div>
                                <div class="col-2 mb-5">
                                    <a class="text-elegance" data-toggle="theme"
                                        data-theme="{{ asset('/css/themes/elegance.css') }}" href="javascript:void(0)">
                                        <i class="fa fa-2x fa-circle"></i>
                                    </a>
                                </div>
                                <div class="col-2 mb-5">
                                    <a class="text-pulse" data-toggle="theme"
                                        data-theme="{{ asset('/css/themes/pulse.css') }}" href="javascript:void(0)">
                                        <i class="fa fa-2x fa-circle"></i>
                                    </a>
                                </div>
                                <div class="col-2 mb-5">
                                    <a class="text-flat" data-toggle="theme"
                                        data-theme="{{ asset('/css/themes/flat.css') }}" href="javascript:void(0)">
                                        <i class="fa fa-2x fa-circle"></i>
                                    </a>
                                </div>
                                <div class="col-2 mb-5">
                                    <a class="text-corporate" data-toggle="theme"
                                        data-theme="{{ asset('/css/themes/corporate.css') }}" href="javascript:void(0)">
                                        <i class="fa fa-2x fa-circle"></i>
                                    </a>
                                </div>
                                <div class="col-2 mb-5">
                                    <a class="text-earth" data-toggle="theme"
                                        data-theme="{{ asset('/css/themes/earth.css') }}" href="javascript:void(0)">
                                        <i class="fa fa-2x fa-circle"></i>
                                    </a>
                                </div>
                            </div>
                            <h6 class="dropdown-header">Header</h6>
                            <div class="row gutters-tiny text-center mb-5">
                                <div class="col-6">
                                    <button type="button" class="btn btn-sm btn-block btn-alt-secondary"
                                        data-toggle="layout" data-action="header_fixed_toggle">Fixed Mode</button>
                                </div>
                                <div class="col-6">
                                    <button type="button"
                                        class="btn btn-sm btn-block btn-alt-secondary d-none d-lg-block mb-10"
                                        data-toggle="layout" data-action="header_style_classic">Classic Style</button>
                                </div>
                            </div>
                            <h6 class="dropdown-header">Sidebar</h6>
                            <div class="row gutters-tiny text-center mb-5">
                                <div class="col-6">
                                    <button type="button" class="btn btn-sm btn-block btn-alt-secondary mb-10"
                                        data-toggle="layout" data-action="sidebar_style_inverse_off">Light</button>
                                </div>
                                <div class="col-6">
                                    <button type="button" class="btn btn-sm btn-block btn-alt-secondary mb-10"
                                        data-toggle="layout" data-action="sidebar_style_inverse_on">Dark</button>
                                </div>
                            </div>
                            <div class="d-none d-xl-block">
                                <h6 class="dropdown-header">Main Content</h6>
                                <button type="button" class="btn btn-sm btn-block btn-alt-secondary mb-10"
                                    data-toggle="layout" data-action="content_layout_toggle">Toggle Layout</button>
                            </div>
                        </div>
                    </div>
                    <!-- END Layout Options -->
                </div>
                <!-- END Left Section -->

                <!-- Right Section -->
                <div class="content-header-section">
                    <!-- User Dropdown -->
                    <div class="btn-group" role="group">
                        <button type="button" class="btn btn-rounded btn-dual-secondary" id="page-header-user-dropdown"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fa fa-user d-sm-none"></i>
                            <span class="d-none d-sm-inline-block">{{ Auth::user()->name }}</span>
                            <i class="fa fa-angle-down ml-5"></i>
                        </button>
                        <div class="dropdown-menu dropdown-menu-right min-width-200"
                            aria-labelledby="page-header-user-dropdown">
                            <h5 class="h6 text-center py-10 mb-5 border-b text-uppercase">Usuário</h5>
                            <a class="dropdown-item" href="{{ route('minhaconta.index') }}">
                                <i class="si si-user mr-5"></i> Minha Conta
                            </a>
                            <a class="dropdown-item d-flex align-items-center justify-content-between"
                                href="javascript:void(0)">
                                <span><i class="si si-envelope-open mr-5"></i> Mensagens</span>
                                <span class="badge badge-primary">3</span>
                            </a>
                            <a class="dropdown-item" href="{{ route('tickets.index') }}">
                                <i class="si si-note mr-5"></i> Tickets
                            </a>
                            <div class="dropdown-divider"></div>

                            <!-- Toggle Side Overlay -->
                            <!-- Layout API, functionality initialized in Template._uiApiLayout() -->
                            <a class="dropdown-item" href="{{ route('parametros.index') }}" data-toggle="layout"
                                data-action="side_overlay_toggle">
                                <i class="si si-wrench mr-5"></i> Configurações
                            </a>
                            <!-- END Side Overlay -->

                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="{{ route('logoutApi') }}">
                                <i class="si si-logout mr-5"></i> Sair
                            </a>
                        </div>
                    </div>
                    <!-- END User Dropdown -->

                    <!-- Notifications -->
                    <div class="btn-group" role="group">
                        <button type="button" class="btn btn-rounded btn-dual-secondary" id="page-header-notifications"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fa fa-flag"></i>
                            <span class="badge badge-danger badge-pill">5</span>
                        </button>
                        <div class="dropdown-menu dropdown-menu-right min-width-300"
                            aria-labelledby="page-header-notifications">
                            <h5 class="h6 text-center py-10 mb-0 border-b text-uppercase">Notificações</h5>
                            <ul class="list-unstyled my-20">

                                <li>
                                    <a class="text-body-color-dark media mb-15" href="{{ route('parametros.index') }}">
                                        <div class="ml-5 mr-15">
                                            <i class="fa fa-fw fa-exclamation-triangle text-warning"></i>
                                        </div>
                                        <div class="media-body pr-10">
                                            <p class="mb-0">É necessário confirgurar suas formas de recebimento!</p>
                                            <div class="text-muted font-size-sm font-italic">Configurações Iniciais !!!
                                            </div>
                                        </div>
                                    </a>
                                </li>
                                <li>
                                    <a class="text-body-color-dark media mb-15" href="javascript:void(0)">
                                        <div class="ml-5 mr-15">
                                            <i class="fa fa-fw fa-exclamation-triangle text-warning"></i>
                                        </div>
                                        <div class="media-body pr-10">
                                            <p class="mb-0">É necessário confirgurar seu servidor de e-Mail, assim seus
                                                clientes poderão receber suas notificações.</p>
                                            <div class="text-muted font-size-sm font-italic">Configurações Iniciais !!!
                                            </div>
                                        </div>
                                    </a>
                                </li>
                                <li>
                                    <a class="text-body-color-dark media mb-15" href="javascript:void(0)">
                                        <div class="ml-5 mr-15">
                                            <i class="fa fa-fw fa-exclamation-triangle text-warning"></i>
                                        </div>
                                        <div class="media-body pr-10">
                                            <p class="mb-0">Please consider upgrading your plan. You are running out of
                                                space.</p>
                                            <div class="text-muted font-size-sm font-italic">16 hours ago</div>
                                        </div>
                                    </a>
                                </li>
                                <li>
                                    <a class="text-body-color-dark media mb-15" href="javascript:void(0)">
                                        <div class="ml-5 mr-15">
                                            <i class="fa fa-fw fa-plus text-primary"></i>
                                        </div>
                                        <div class="media-body pr-10">
                                            <p class="mb-0">New purchases! +$250</p>
                                            <div class="text-muted font-size-sm font-italic">1 dia</div>
                                        </div>
                                    </a>
                                </li>
                            </ul>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item text-center mb-0" href="javascript:void(0)">
                                <i class="fa fa-flag mr-5"></i> Ver todas
                            </a>
                        </div>
                    </div>
                    <!-- END Notifications -->

                    <!-- Toggle Side Overlay -->
                    <!-- Layout API, functionality initialized in Template._uiApiLayout() -->
                    <button type="button" class="btn btn-circle btn-dual-secondary" data-toggle="layout"
                        data-action="side_overlay_toggle">
                        <i class="fa fa-tasks"></i>
                    </button>
                    <!-- END Toggle Side Overlay -->
                </div>
                <!-- END Right Section -->
            </div>
            <!-- END Header Content -->

            <!-- Header Search -->
            <div id="page-header-search" class="overlay-header">
                <div class="content-header content-header-fullrow">
                    <form action="/dashboard" method="POST">
                        @csrf
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <!-- Close Search Section -->
                                <!-- Layout API, functionality initialized in Template._uiApiLayout() -->
                                <button type="button" class="btn btn-secondary" data-toggle="layout"
                                    data-action="header_search_off">
                                    <i class="fa fa-times"></i>
                                </button>
                                <!-- END Close Search Section -->
                            </div>
                            <input type="text" class="form-control" placeholder="Search or hit ESC.."
                                id="page-header-search-input" name="page-header-search-input">
                            <div class="input-group-append">
                                <button type="submit" class="btn btn-secondary">
                                    <i class="fa fa-search"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <!-- END Header Search -->

            <!-- Header Loader -->
            <!-- Please check out the Activity page under Elements category to see examples of showing/hiding it -->
            <div id="page-header-loader" class="overlay-header bg-primary">
                <div class="content-header content-header-fullrow text-center">
                    <div class="content-header-item">
                        <i class="fa fa-sun-o fa-spin text-white"></i>
                    </div>
                </div>
            </div>
            <!-- END Header Loader -->
        </header>
        <!-- END Header -->

        <!-- Main Container -->
        <main id="main-container">
            @yield('content')
        </main>
        <!-- END Main Container -->

        <!-- Footer -->
        <footer id="page-footer" class="opacity-0">
            <div class="content py-20 font-size-xs clearfix">
                <div class="float-right">
                    Criado com muito <i class="fa fa-heart text-pulse"></i> pela <a class="font-w600"
                        href="//softwork.com.br " target="_blank">SoftWork</a>
                </div>
                <div class="float-left">
                    <a class="font-w600" href="http:www.atitudeagenda.com.br" target="_blank">Atitude Agenda</a> &copy;
                    <span class="js-year-copy"></span>
                </div>
            </div>
        </footer>
        <!-- END Footer -->


        <!-- Modal Nova foto -->
        <div class="modal fade" id="novaFoto" tabindex="-1">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-light">
                        <legend> Alterar Foto de Usuario</legend>
                    </div>
                    <div class="modal-body">
                        <div class="container-fluid">
                            <form action="{{ route('users.update', Auth::user()->id) }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="form-row">
                                    <div class="div-row">
                                        <img class="img-avatar img-avatar128" src="{{ asset(Auth::user()->imagem) }}"
                                            alt="">

                                    </div>

                                    <div class="col-md-2 my-5" style="display: none;">
                                        <div class="form-material hidden">
                                            <label>Criado Por:</label>
                                            <select name="id" class="form-control" selected>
                                                <option value="{{ Auth::user()->id }}"></option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-2 my-5" style="display: none;">
                                        <div class="form-material hidden">
                                            <label>Nome:</label>
                                            <select name="name" class="form-control" selected>
                                                <option value="{{ Auth::user()->name }}"></option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-2 my-5" style="display: none;">
                                        <div class="form-material hidden">
                                            <label>Nome:</label>
                                            <select name="email" class="form-control" selected>
                                                <option value="{{ Auth::user()->email }}"></option>
                                            </select>
                                        </div>
                                    </div>


                                    <div class="form-group col-md-4 my-5">
                                        <label for="imagem">Anexe sua nova foto</label>
                                        <input type="file" name="imagem"> @csrf
                                    </div>

                                </div>
                        </div>

                        <br>
                        <div class="col-sm-12 text-right">
                            <a type="button" class="btn btn-alt-danger"
                                href="{{ route('user.removefoto', Auth::user()->id) }}">
                                <i class="fa fa-close mr-5"></i> Remover Foto</a>
                            <button type="button" class="btn btn-alt-warning" data-dismiss="modal">
                                <i class="si si-action-undo mr-5"></i> Cancelar</button>
                            <button type="submit" class="btn btn-alt-success">
                                <i class="fa fa-check"></i> Salvar</button>
                        </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <!-- Final do Modal -->

    </div>
    <!-- END Page Container -->

    <!-- Codebase Core JS -->
    <script src="{{ asset('js/codebase.app.js') }}"></script>

    <!-- Laravel Scaffolding JS -->
    <script src="{{ asset('js/laravel.app.js') }}"></script>

    @yield('js_after')
</body>

</html>
