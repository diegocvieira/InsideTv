@php
    $body_class = 'page-genero';
@endphp

@extends('base')

@section('content')
    <div class="container page-normal" id="admin-page">
        @if(isset($genero))
            {{ Form::model($genero, ['action' => ['GeneroController@update', $genero->id], 'id' => 'form-genero', 'method' => 'put']) }}
        @else
            {{ Form::open(['action' => 'GeneroController@store', 'id' => 'form-genero']) }}
        @endif
            <div class="row">
                <div class="col m6 offset-m3 s12 center">
                    <div class="input-field">
                        {{ Form::label('nome', 'Nome') }}
                        {{ Form::input('text', 'nome') }}
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col s12 center">
                    <button class="submit btn" type="submit" name="action">Salvar
                        <i class="material-icons right">send</i>
                    </button>
                </div>
            </div>
        {{ Form::close() }}
    </div>
@endsection

@section('scripts')
    <script>
        $("#form-genero").validate({
           rules: {
                 nome: {
                    required: true,
                    maxlength: 30
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
