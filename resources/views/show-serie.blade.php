@extends('base')

@section('content')
    <script>
        var serie_id = "<?php echo $serie->id; ?>";
    </script>

    <div class="container page-normal" id="serie-page">
        <div style="background-image: url('/images/series/{{ $serie->id }}/{{ $serie->capa }}');" class="capa"></div>

        <div class="row">
            <div class="col s12">
                <div title="{{ $serie->titulo_original }}" class="poster" style="background-image: url('/images/series/{{ $serie->id }}/{{ $serie->poster }}');"></div>

                <h1 class="titulo">{{ $serie->titulo_original }}</h1>
            </div>
        </div>

        <div class="row">
            <div class="col m8 s12 sinopse">
                <h3>Sinopse</h3>
                <p>{{ $serie->sinopse }}</p>

                @if($serie->trailer)
                    <h3>Trailer</h3>
                    <div id="videoWithJs" class="videoWrapper">
                        <iframe src="{{ $serie->trailer }}" frameborder="0" allowfullscreen></iframe>
                    </div>
                @endif
            </div>

            <div class="col m4 s12 infos">
                @if(Auth::check())

                    {{ Form::model($serie->lista_serie, ['action' => 'ListaController@store', 'id' => 'form-lista']) }}
                        {{ Form::hidden('serie_id', $serie->id) }}
                        {{ Form::hidden('user_id', Auth::user()->id) }}

                        {{ Form::select('lista_id', [null => 'Criar nova lista'] + $listas) }}

                        <div id="nova-lista" class="input-field">
                            {{ Form::text('nova_lista') }}
                            {{ Form::label('nova_lista', 'Nome da nova lista') }}

                            {{ Form::submit('Salvar', ['class' => 'btn']) }}
                        </div>
                    {{ Form::close() }}

                    <hr>
                @endif


                <div id="avaliacao">
                    <i class="material-icons left">stars</i>

                    <span>{{ $nota->nota_final }}/5</span>

                    @if(Auth::check())
                        {{ Form::model($serie->avaliacao->first(), ['action' => 'AvaliarController@store', 'id' => 'form-avaliar']) }}
                            {{ Form::hidden('serie_id', $serie->id) }}
                            {{ Form::hidden('user_id', Auth::user()->id) }}

                            {{ Form::radio('nota', 5, null, ['id' => 'nota5']) }}
                            <label for="nota5" title="Ótima"><i class="material-icons">sentiment_very_satisfied</i></label>

                            {{ Form::radio('nota', 4, null, ['id' => 'nota4']) }}
                            <label for="nota4" title="Boa"><i class="material-icons">sentiment_satisfied</i></label>

                            {{ Form::radio('nota', 3, null, ['id' => 'nota3']) }}
                            <label for="nota3" title="Regular"><i class="material-icons">sentiment_neutral</i></label>

                            {{ Form::radio('nota', 2, null, ['id' => 'nota2']) }}
                            <label for="nota2" title="Ruim"><i class="material-icons">sentiment_dissatisfied</i></label>

                            {{ Form::radio('nota', 1, null, ['id' => 'nota1']) }}
                            <label for="nota1" title="Muito ruim"><i class="material-icons">sentiment_very_dissatisfied</i></label>
                        {{ Form::close() }}
                    @endif
                </div>

                <hr>

                <div class="title-section">
                    <h3><i class="material-icons left">date_range</i>Data de lançamento</h3>
                    <span>{{ date('d/m/Y', strtotime($serie->data_lancamento)) }}</span>
                </div>

                <div class="title-section">
                    <h3><i class="material-icons left">trending_up</i>Status</h3>
                    <span>{{ $serie->gerarStatus($serie->status) }}</span>
                </div>

                <div class="title-section">
                    <h3><i class="left material-icons">live_tv</i>Emissora</h3>
                    <a href="#">{{ $serie->emissora->nome }}</a>
                </div>

                <div class="title-section">
                    <h3><i class="left material-icons">movie_filter</i>Gênero</h3>
                    @foreach($serie->sergen as $generos)
                        <a href="#">{{ $generos->genero->nome }}</a>
                    @endforeach
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col m6 s12 comentarios">
                <h3>Comentários</h3>

                @if(Auth::check())
                    <div class="row">
                        {{ Form::open(['action' => 'ComentarioSerieController@store', 'class' => 'col s12 input-field', 'id' => 'form-comentario-serie']) }}
                            {{ Form::textarea('descricao', null, ['data-length' => '200', 'maxlength' => '200', 'class' => 'materialize-textarea']) }}
                            {{ Form::label('descricao', 'Escreva um comentário sobre ' . $serie->titulo_original) }}

                            {{ Form::hidden('serie_id', $serie->id) }}
                            {{ Form::hidden('user_id', Auth::user()->id) }}

                            <button class="btn right"><i class="material-icons right">send</i>Salvar</button>
                        {{ Form::close() }}
                    </div>
                @endif

                {{ Form::select('', ['recente' => 'mais recentes', 'antigo' => 'mais antigos'], null, ['id' => 'filtro-comentarios']) }}

                <div class="row results"></div>
            </div>

            <div class="col m6 s12 atividades">
                <div class="row results-atividades"></div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('js/show-serie.js') }}"></script>
@endsection
