@extends('base')

@section('content')
    <div class="container page-normal" id="admin-page">
        @if(isset($emissora))
            {{ Form::model($emissora, ['action' => ['EmissoraController@update', $emissora->id], 'id' => 'form-emissora', 'method' => 'put']) }}
        @else
            {{ Form::open(['action' => 'EmissoraController@store', 'id' => 'form-emissora', 'enctype' => 'multipart/form-data']) }}
        @endif
            <div class="row">
                <div class="col m6 offset-m3 s12 center">
                    <div class="input-field">
                        {{ Form::label('nome', 'Nome') }}
                        {{ Form::text('nome') }}
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col s12 center">
                    <button class="btn" type="submit" name="action">Salvar
                        <i class="material-icons right">send</i>
                    </button>
                </div>
            </div>
        {{ Form::close() }}
    </div>
@endsection

@section('scripts')
    <script>
        $("#form-emissora").validate({
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
