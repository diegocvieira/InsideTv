@php
    $body_class = 'page-serie';
@endphp

@extends('base')

@section('content')
    <div class="container page-normal" id="admin-page">
        @if(isset($serie))
            {{ Form::model($serie, ['action' => ['SerieController@update', $serie->id], 'id' => 'form-serie', 'method' => 'put', 'enctype' => 'multipart/form-data']) }}
        @else
            {{ Form::open(['action' => 'SerieController@store', 'id' => 'form-serie', 'enctype' => 'multipart/form-data']) }}
        @endif

            <div class="row">
                <div class="input-field col m6 s12">
                    {{ Form::text('titulo') }}
                    {{ Form::label('titulo', 'Título') }}
                </div>

                <div class="input-field col m6 s12">
                    {{ Form::text('titulo_original') }}
                    {{ Form::label('titulo_original', 'Título original') }}
                </div>
            </div>

            <div class="row">
                <div class="input-field col m4 s12">
                    {{ Form::select('emissora_id', $emissoras) }}
                    {{ Form::label('emissora_id', 'Emissora') }}
                </div>

                <div class="input-field col m4 s12">
                    {{ Form::select('status', $status) }}
                    {{ Form::label('status', 'Status') }}
                </div>

                <div class="input-field col m4 s12">
                    {{ Form::select('genero_id[]', $generos, isset($generos_select) ? $generos_select : '', ['multiple' => 'multiple', 'id' => 'genero']) }}
                    {{ Form::label('genero_id', 'Gênero') }}
                </div>
            </div>

            <div class="row">
                <div class="input-field col m6 s12">
                    {{ Form::text('data_lancamento', null, ['class' => 'datepicker']) }}
                    {{ Form::label('data_lancamento', 'Data de lançamento') }}
                </div>

                <div class="input-field col m6 s12">
                    {{ Form::text('trailer') }}
                    {{ Form::label('trailer', 'Trailer') }}
                </div>
            </div>

            <div class="row">
                <div class="input-field col s12">
                    {{ Form::textarea('sinopse', null, ['class' => 'materialize-textarea', 'data-length' => '5000']) }}
                    {{ Form::label('sinopse', 'Sinopse') }}
                </div>
            </div>

            <div class="row">
                <div class="col m6 s12">
                    <div class="file-field input-field">
                        <div class="btn">
                            <span>Poster</span>
                            {{ Form::file('poster', ['id' => 'img-poster', 'class' => 'upload-img', 'accept' => 'image/*']) }}
                        </div>

                        <div class="file-path-wrapper">
                            {{ Form::text('', '', ['class' => 'file-path validate', 'placeholder' => 'Nenhum poster carregado...']) }}
                         </div>
                     </div>

                     <div class="poster-capa">
                         @if(isset($serie))
                             <center><div id="img-poster-preview" style="background-image: url({{ asset('images/series/' . $serie->id . '/' . $serie->poster) }})"></div></center>
                         @else
                             <center><div id="img-poster-preview" style="display: none;"></div></center>
                         @endif
                     </div>
                </div>

                <div class="col m6 s12">
                    <div class="file-field input-field">
                        <div class="btn">
                            <span>Capa</span>
                            {{ Form::file('capa', ['id' => 'img-capa', 'class' => 'upload-img', 'accept' => 'image/*']) }}
                        </div>

                        <div class="file-path-wrapper">
                            {{ Form::text('', '', ['class' => 'file-path validate', 'placeholder' => 'Nenhuma capa carregada...']) }}
                         </div>
                    </div>

                    <div class="poster-capa">
                        @if(isset($serie))
                            <center><div id="img-capa-preview" style="background-image: url({{ asset('images/series/' . $serie->id . '/' . $serie->capa) }})"></div></center>
                        @else
                            <center><div id="img-capa-preview" style="display: none;"></div></center>
                        @endif
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="input-field col s12 center">
                    <button class="btn submit" type="submit" name="action">Salvar
                        <i class="material-icons right">send</i>
                    </button>
                </div>
            </div>
        {{ Form::close() }}
    </div>
@endsection

@section('scripts')
    <script>
        $("#form-serie").validate({
            ignore: $(':hidden'),
           rules: {
               titulo_original: {
                    required: true,
                    maxlength: 100
                },
                titulo: {
                   maxlength: 100
               },
               trailer: {
                  maxlength: 200
              },
              sinopse: {
                 maxlength: 5000
            },
            "genero_id[]": { required: true }
           },
           highlight: function(input){
                $(input).addClass("error");

                if($(input).attr('id') == 'genero')
                    $(input).prev().prev().addClass('error');
            },
            unhighlight: function(input){
                $(input).removeClass("error");
            },
            errorPlacement: function(error, element){}
        });

        $(".upload-img").change(function(){
            var id = $(this).attr('id');
            var input = document.getElementById(id);

            if(input.files[0].size > 5100000)
                Materialize.toast("A imagem não pode ter mais de 5mb", 5000);

            else{
                if(input.files && input.files[0]){
                    var reader = new FileReader();

                    reader.onload = function(e){
                        $('#' + id + '-preview').show();
                        $('#' + id + '-preview').css('background-image', 'url(' + e.target.result + ')');
                    }

                    reader.readAsDataURL(input.files[0]);
                }
            }
        });

        $('.datepicker').pickadate({
            monthsFull: ['Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro'],
            monthsShort: ['Jan', 'Fev', 'Mar', 'Abr', 'Mai', 'Jun', 'Jul', 'Ago', 'Set', 'Out', 'Nov', 'Dez'],
            weekdaysFull: ['Domingo', 'Segunda', 'Terça', 'Quarta', 'Quinta', 'Sexta', 'Sabádo'],
            weekdaysShort: ['Dom', 'Seg', 'Ter', 'Qua', 'Qui', 'Sex', 'Sab'],
            today: 'Hoje',
            clear: 'Limpar',
            close: 'Pronto',
            labelMonthNext: 'Próximo mês',
            labelMonthPrev: 'Mês anterior',
            labelMonthSelect: 'Selecione um mês',
            labelYearSelect: 'Selecione um ano',
            selectMonths: true,
            selectYears: 15
        });
    </script>
@endsection
