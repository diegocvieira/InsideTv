<?php
    $html_class = 'html_listas';
?>

@extends('base')

@section('content')
    <div class="container-fluid page-normal" id="listas-page">
        <div id="listas" v-el:click="showModal = false">
            @foreach($listas as $lista)
                <div class="lista" data-id="{{ $lista->id }}">
                    <div class="topo">
                        {{ Form::text('descricao', $lista->descricao, ['class' => 'nome-lista', 'v-on:keyup.13' => 'editName']) }}

                        {{ Form::select('serie_id', [null => 'Selecione a série'] + $series, ['class' => 'select-serie']) }}

                        <!--<div class="options-serie">
                            <i class="large material-icons">more_horiz</i>


                        </div>-->

                        <template-options-lista class="options-serie"></template-options-lista>
                    </div>




                    <ul class="drop">
                        @if(count($lista->listas_serie) == 0)
                            <span class="sem-lista">Arraste alguma série para aqui</span>
                        @endif

                        @foreach($lista->listas_serie as $serie)
                            <li class="serie" data-id="{{ $serie->serie->id }}">
                                <span class="serie-nome">
                                    {{ $serie->serie->titulo_original }}
                                </span>

                                <!--<div class="options-serie">
                                    <i class="large material-icons">more_horiz</i>

                                    <ul class="sub_options">
                                        <li><a href="{{ route('show-serie', $serie->serie->slug) }}">Ir para a página da série</a></li>
                                        <li><a href="#" class="remove-serie">Remover da lista</a></li>
                                    </ul>
                                </div>-->
                            </li>

                            <!--<li class="serie" data-id="{{ $serie->serie->id }}">
                                <span class="serie-nome">
                                    {{ $serie->serie->titulo_original }}
                                </span>
                                <div class="options-serie">
                                    <i class="large material-icons">more_horiz</i>
                                    <ul class="sub_options">
                                        <li><a href="{{ route('show-serie', $serie->serie->slug) }}">Ir para a página da série</a></li>
                                        <li>Remover da lista</li>
                                    </ul>
                                </div>
                            </li>
                            <li class="serie" data-id="{{ $serie->serie->id }}">
                                <span class="serie-nome">
                                    {{ $serie->serie->titulo_original }}
                                </span>
                                <div class="options-serie">
                                    <i class="large material-icons">more_horiz</i>
                                    <ul class="sub_options">
                                        <li><a href="{{ route('show-serie', $serie->serie->slug) }}">Ir para a página da série</a></li>
                                        <li>Remover da lista</li>
                                    </ul>
                                </div>
                            </li>
                            <li class="serie" data-id="{{ $serie->serie->id }}">
                                <span class="serie-nome">
                                    {{ $serie->serie->titulo_original }}
                                </span>
                                <div class="options-serie">
                                    <i class="large material-icons">more_horiz</i>
                                    <ul class="sub_options">
                                        <li><a href="{{ route('show-serie', $serie->serie->slug) }}">Ir para a página da série</a></li>
                                        <li>Remover da lista</li>
                                    </ul>
                                </div>
                            </li>-->

                        @endforeach
                    </ul>



                </div>
                <!--<div class="lista">
                    <div class="titulo">{{ $lista->descricao }}</div>
                    @if(count($lista->listas_serie) == 0)
                        <span class="sem-lista">Adicione alguma série para esta lista</span>
                    @endif
                    <ul class="drop">
                        <span></span>
                        @foreach($lista->listas_serie as $serie)
                            <li class="serie">
                                {{$serie->serie->titulo_original}}
                            </li>
                        @endforeach
                    </ul>
                </div>
                <div class="lista">
                    <div class="titulo">{{ $lista->descricao }}</div>
                    @if(count($lista->listas_serie) == 0)
                        <span class="sem-lista">Adicione alguma série para esta lista</span>
                    @endif
                    <ul class="drop">
                        <span></span>
                        @foreach($lista->listas_serie as $serie)
                            <li class="serie">
                                {{$serie->serie->titulo_original}}
                            </li>
                        @endforeach
                    </ul>
                </div>
                <div class="lista">
                    <div class="titulo">{{ $lista->descricao }}</div>
                    @if(count($lista->listas_serie) == 0)
                        <span class="sem-lista">Adicione alguma série para esta lista</span>
                    @endif
                    <ul class="drop">
                        <span></span>
                        @foreach($lista->listas_serie as $serie)
                            <li class="serie">
                                {{$serie->serie->titulo_original}}
                            </li>
                        @endforeach
                    </ul>
                </div>
                <div class="lista">
                    <div class="titulo">{{ $lista->descricao }}</div>
                    @if(count($lista->listas_serie) == 0)
                        <span class="sem-lista">Adicione alguma série para esta lista</span>
                    @endif
                    <ul class="drop">
                        <span></span>
                        @foreach($lista->listas_serie as $serie)
                            <li class="serie">
                                {{$serie->serie->titulo_original}}
                            </li>
                        @endforeach
                    </ul>
                </div>-->

            @endforeach
        </div>
    </div>
@endsection

@section('scripts')
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.4/angular.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/vue/2.0.5/vue.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/vue-resource@1.3.5"></script>
    <script src="{{ asset('js/listas.js') }}"></script>
    <!--<script src="{{ asset('js/angular/InsidetvModule.js') }}"></script>
    <script src="{{ asset('js/angular/InsidetvConfig.js') }}"></script>
    <script src="{{ asset('js/angular/ListaController.js') }}"></script>-->
@endsection
