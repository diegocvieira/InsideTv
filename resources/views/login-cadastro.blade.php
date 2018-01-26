@php
    $title = 'Login/Cadastro - InsideTv';
@endphp

@extends('base')

@section('content')
    <div class="container page-normal" id="page-login-cadastro">
        <div class="menu row">
            <div class="col m6 s12 offset-m3">
                <a href="#" data-id="login" class="btn">Login</a>
                <a href="#" data-id="cadastro" class="btn">Cadastro</a>
            </div>
        </div>

        <div class="row">
            {{ Form::open(['action' => 'UserController@login', 'class' => 'show-hide col m6 offset-m3 s12', 'id' => 'form-login']) }}
                <div class="input-field">
                    <i class="material-icons prefix">mail</i>
                    {{ Form::input('email', 'email') }}
                    {{ Form::label('email', 'E-mail') }}
                </div>

                <div class="input-field">
                    <i class="material-icons prefix">vpn_key</i>
                    {{ Form::input('password', 'password') }}
                    {{ Form::label('password', 'Senha') }}
                </div>

                <div class="row">
                    <div class="col s6">
                        {{ Form::input('checkbox', 'remember', true, ['id' => 'filled-in-box', 'class' => 'filled-in']) }}
                        {{ Form::label('filled-in-box', 'lembrar') }}
                    </div>

                    <div class="col s6">
                        <a href="#" class="right esqueci-senha">esqueci minha senha</a>
                    </div>
                </div>

                <div class="row">
                    <div class="col s12 center">
                        <button class="btn submit"><i class="material-icons right">send</i>Entrar</button>
                    </div>
                </div>

                <div class="row">
                    <div class="col s12 center">
                        <hr>
                        <a href="{{url('/redirect')}}" class="btn login-facebook">Login com Facebook</a>
                    </div>
                </div>
            {{ Form::close() }}

            {{ Form::open(['action' => 'UserController@cadastro', 'class' => 'show-hide col m8 offset-m2 s12', 'id' => 'form-cadastro']) }}
                <div class="row">
                    <div class="col m6 s12 input-field">
                        {{ Form::input('text', 'nome') }}
                        {{ Form::label('nome', 'Nome') }}
                    </div>

                    <div class="col m6 s12 input-field">
                        {{ Form::input('text', 'sobrenome') }}
                        {{ Form::label('sobrenome', 'Sobrenome') }}
                    </div>
                </div>

                <div class="row">
                    <div class="input-field col s12">
                        {{ Form::input('email', 'email') }}
                        {{ Form::label('email', 'E-mail') }}
                    </div>
                </div>

                <div class="row">
                    <div class="col m6 s12 input-field">
                        {{ Form::input('password', 'password', null, ['id' => 'password']) }}
                        {{ Form::label('password', 'Senha') }}
                    </div>

                    <div class="col m6 s12 input-field">
                        {{ Form::input('password', 'password_confirm') }}
                        {{ Form::label('password_confirm', 'Repetir senha') }}
                    </div>
                </div>

                <div class="row">
                    <div class="col s12 center">
                        <button class="btn submit"><i class="material-icons right">send</i>Cadastrar</button>
                    </div>
                </div>
            {{ Form::close() }}
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function(){
            $('.menu .col a:first-child').addClass('selected');
        });

        $(document).on('click', '.menu a', function(){
            $('.menu a').removeClass('selected');
            $(this).addClass('selected');

            if($(this).attr('data-id') == 'login'){
                $('#form-login').show();
                $('#form-cadastro').hide();
            }

            else{
                $('#form-login').hide();
                $('#form-cadastro').show();
            }
        });

        $("#form-login").validate({
           rules: {
                 email: {
                    required: true,
                    email: true
                 },
                 password: {
                    required: true
                 }
           },
           highlight: function(input){
                $(input).addClass("error");
            },
            unhighlight: function(input){
                $(input).removeClass("error");
            },
            errorPlacement: function(error, element){}
        });

        $("#form-cadastro").validate({
           rules: {
                 nome: {
                    required: true
                 },
                 sobrenome: {
                    required: true
                },
                email: {
                    required: true,
                    email: true
                },
                password: {
                    required: true
                },
                password_confirm: {
                    required: true,
                    equalTo: "#password"
                }
           },
           highlight: function(input){
                $(input).addClass("error");
            },
            unhighlight: function(input){
                $(input).removeClass("error");
            },
            errorPlacement: function(error, element){}
        });
    </script>
@endsection
