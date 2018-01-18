@php
    $body_class = 'index';
@endphp

@extends('base')

@section('content')
    <!--INICIO DO BANNER-->
    <div class="banner">
        <video autoplay loop poster="{{ asset('images/insidetv-banner.jpg') }}">
           <source src="{{ asset('images/insidetv-banner.mp4') }}" type="video/mp4"><!--APARECE NO COMPUTADOR-->
        </video>

        <img src="{{ asset('images/insidetv-banner.jpg') }}"><!--APARECE NO SMARTPHONE-->

        <div class="conteudo">
            <div class="descricao">
                <span id="texto"></span>
                <div class="cursor">|</div>
            </div>

        </div>
    </div>
    <!--FIM DO BANNER-->



    <a class="" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="right material-icons">exit_to_app</i>Sair</a>
    {{ Form::open(['route' => 'logout', 'id' => 'logout-form', 'style' => 'display:none;']) }}
    {{ Form::close() }}
@endsection
