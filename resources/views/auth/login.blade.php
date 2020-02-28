<!doctype html>
<html lang="{{ config('app.locale') }}" class="no-focus">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">

    <title>AtitudeAgenda - Login</title>
    <meta name="description" content="Atitude Agenda - Um software da SoftWork Comércio e Serviços de Informática Ltda">
    <meta name="author" content="SoftWork Comércio e Serviços de Informática Ltda">
    <meta name="robots" content="noindex, nofollow">

    <!-- Favicon icon -->
    <link rel="shortcut icon" href="{{ mix('images/favicon.ico') }}" type="image/x-icon">
    <link rel="icon" href="{{ mix('images/favicon.ico') }}" type="image/x-icon">
    {{-- Fonts --}}
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Muli:300,400,400i,600,700">

    <link rel="stylesheet" id="css-main" href="{{ mix('app/css/app.css') }}">
    <link rel="stylesheet" href="{{ mix('assets/sweetalert2/css/sweetalert2.min.css') }}" />


    <!-- Stylesheets -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        .bg-image {
            background-position: 0 70%;
            background-size: cover;
        }
        .bg-image-login {
            background-image: url('landing/images/landingpage/data-ex.jpg');

        }

    </style>

</head>

<!-- Page Container -->

<div id="page-container" class="main-content-boxed">

    <!-- Main Container -->
    <main id="main-container">

        <!-- Page Content -->
        <div class="bg-image bg-image-login">
            <div class="row mx-0 bg-flat-dark-op">

                <div class="hero-static col-md-6 col-xl-8 d-none d-md-flex align-items-md-end">
                    <div class="p-30 invisible" data-toggle="appear">
                        <p class="font-size-h3 font-w600 text-white mb-5">
                            "Determinação, coragem e autoconfiança são fatores decisivos para o sucesso. Se estamos
                            possuídos por uma inabalável determinação, conseguiremos superá-los. Independentemente das
                            circunstâncias, devemos ser sempre humildes, recatados e despidos de orgulho."
                        </p>
                        <p class="small text-white">Dalai Lama</p>
                        <p class="font-size-h5 text-white">
                            <i class="fa fa-angles-right"></i>Bem vindo ao Atitude Agenda ...
                        </p>
                        <p class="font-italic text-white-op">
                            Copyright &copy; <span class="js-year-copy"></span>
                            <small class="text-success">SoftWork Comércio e Serviços de Informática Ltda. Todos os
                                direitos reservados.</small>
                        </p>
                    </div>
                </div>

                <div class="hero-static col-md-6 col-xl-4 d-flex align-items-center bg-white invisible"
                    data-toggle="appear" data-class="animated fadeInRight">
                    <div class="content content-full">
                        <!-- Header -->
                        <div class="px-30 py-10 text-center">
                            <a class="font-w700" href="{{ route('home') }}">
                                <img src="{{asset('imagens/logoSF_horiz.png')}}" class="m-t-15 logo">
                            </a>


                            <h1 class="h1 font-w700 mt-30 mb-10 text-center">Bem vindo!</h1>
                            <h2 class="h5 font-w400 text-muted mb-0">Por favor, efetue seu login!</h2>
                        </div>
                        <!-- END Header -->

                        <!-- Sign In Form -->

                        <form class="js-validation-signin px-30" method="post" autocomplete="off">
                            @csrf
                            <div class="form-group row">
                                <div class="col-12">
                                    <div class="form-material floating">
                                        <input type="text" class="form-control" id="email" name="email">
                                        <label for="email">E-mail</label>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="form-material floating">
                                        <input type="password" class="form-control" id="password" name="password">
                                        <label for="password">Senha</label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-12">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="login-remember-me"
                                            name="login-remember-me">
                                        <label class="custom-control-label" for="login-remember-me">Lembre Me</label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-sm btn-hero btn-alt-success">
                                    <i class="si si-login mr-10"></i> Acessar
                                </button>
                                <div class="mt-30">
                                    <a class="link-effect text-muted mr-10 mb-5 d-inline-block"
                                        href="{{route('cadastro')}}">
                                        <i class="fa fa-plus mr-5"></i>Faça seu Cadastro
                                    </a>
                                    <a class="link-effect text-muted mr-10 mb-5 d-inline-block"
                                        href="op_auth_reminder2.html">
                                        <i class="fa fa-warning mr-5"></i> Esqueci senha
                                    </a>
                                </div>
                            </div>
                        </form>
                        <!-- END Sign In Form -->
                    </div>
                </div>
            </div>
        </div>
        <!-- END Page Content -->

    </main>
    <!-- END Main Container -->
</div>

{{-- <script src="{{ mix('site/site.js')}}"></script>
<script src="{{ mix('site/js/register/codebase.core.min.js')}}"></script>
<script src="{{ mix('site/js/register/codebase.app.min.js')}}"></script>
<script src="{{ mix('site/js/register/jquery-validation/jquery.validate.min.js')}}"></script>
<script src="{{ mix('site/js/validade/cadastro.js')}}"></script>
<script src="{{ mix('assets/sweetalert2/js/sweetalert2.min.js') }}"></script> --}}
<script src="{{ mix('site/js/register/codebase.core.min.js')}}"></script>
<script src="{{ mix('site/js/register/codebase.app.min.js')}}"></script>
<script src="{{ mix('assets/sweetalert2/js/sweetalert2.min.js') }}"></script>


<script src="{{ asset('plugin/notification/js/bootstrap-growl.min.js')}}"></script>
<script src="{{ asset('src/login/login.js') }}" type="text/javascript"></script>

</body>

</html>
