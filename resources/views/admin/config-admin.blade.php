@php
    $title = 'Configurações - InsideTv';
@endphp

@extends('base')

@section('content')
    <div id="admin-page" class="container page-normal">
        {{ Form::open(['action' => 'AdminController@config', 'class' => 'row', 'id' => 'form-config-admin']) }}
            <div class="col s12 m6 offset-m3 input-field">
                {{ Form::input('email', 'email', Auth::user()->email) }}
                {{ Form::label('email', 'E-mail') }}
            </div>

            <div class="col s12 m6 offset-m3 input-field">
                {{ Form::input('password', 'password_old') }}
                {{ Form::label('password_old', 'Senha atual') }}
            </div>

            <div class="col s12 m6 offset-m3 input-field">
                {{ Form::input('password', 'password', null, ['id' => 'password']) }}
                {{ Form::label('password', 'Nova senha') }}
            </div>

            <div class="col s12 m6 offset-m3 input-field">
                {{ Form::input('password', 'password_confirm') }}
                {{ Form::label('password_confirm', 'Repetir nova senha') }}
            </div>

            <div class="col s12 center">
                <button class="btn submit"><i class="material-icons right">send</i>Salvar</button>
            </div>
        {{ Form::close() }}
    </div>
@endsection

@section('scripts')
    <script>
        $("#form-config-admin").validate({
           rules: {
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
                },
                password_old: {
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
    </script>
@endsection
