@extends('errors::layout')

@section('title', __('Not Found'))
@section('code', '404')
@section('message')
<h3 style="color:gray">Erro 404</h3>
<p>
    <small>Normalmente este ocorre quando uma URL/URI não existe, ou não atende aos parâmetros necessários</small>
</p>   
@endsection


