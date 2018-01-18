@php
    $body_class = 'page-serie';
@endphp

@extends('base')

@section('content')
    <div class="container page-normal" id="admin-page">
        <div class="row">
            <div class="col s12">
                <a href="{{ route('serie.create') }}" class="right btn waves-effect waves-light">Cadastrar
                    <i class="material-icons left">add</i>
                </a>
            </div>
        </div>

        <div class="row">
            <div class="col s12">
                <table class="responsive-table centered table">
                    <thead>
                        <tr>
                            <th>Titulo</th>
                            <th>Editar</th>
                            <th>Excluir</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($series as $serie)
                            <tr>
                                <td><a href="{{ route('show-serie', $serie->slug) }}">{{ $serie->titulo_original }}</a></td>

                                <td>
                                    <a href="{{ route('serie.edit', $serie->id) }}" class="btn">Editar
                                        <i class="material-icons left">edit</i>
                                    </a>
                                </td>

                                <td>
                                    <a href="#" id="form-serie-delete" class="btn">Deletar
                                        <i class="material-icons left">delete</i>

                                        {{ Form::open(['method' => 'delete', 'route' => ['serie.destroy', $serie->id], 'id' => 'form-delete']) }}
                                        {{ Form::close() }}
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
