@php
    $body_class = 'page-genero';
@endphp

@extends('base')

@section('content')
    <div class="container page-normal" id="admin-page">
        <div class="row">
            <div class="col s12">
                <a href="{{ route('genero.create') }}" class="right btn waves-effect waves-light">Cadastrar
                    <i class="material-icons left">add</i>
                </a>
            </div>
        </div>

        <div class="row">
            <div class="col s12">
                <table class="responsive-table centered table">
                    <thead>
                        <tr>
                            <th>Nome</th>
                            <th>Editar</th>
                            <th>Excluir</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($generos as $genero)
                            <tr>
                                <td>{{ $genero->nome }}</td>

                                <td>
                                    <a href="{{ route('genero.edit', $genero->id) }}" class="btn">Editar
                                        <i class="material-icons left">edit</i>
                                    </a>
                                </td>

                                <td>
                                    <a href="#" id="form-genero-delete" class="btn">Deletar
                                        <i class="material-icons left">delete</i>

                                        {{ Form::open(['method' => 'delete', 'route' => ['genero.destroy', $genero->id], 'id' => 'form-delete']) }}
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
