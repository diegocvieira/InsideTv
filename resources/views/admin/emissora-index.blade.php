@extends('base')

@section('content')
    <div class="container page-normal" id="admin-page">
        <div class="row">
            <div class="col s12">
                <a href="{{ route('emissora.create') }}" class="right btn waves-effect waves-light">Cadastrar
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
                        @foreach($emissoras as $emissora)
                            <tr>
                                <td>{{ $emissora->nome }}</td>

                                <td>
                                    <a href="{{ route('emissora.edit', $emissora->id) }}" class="btn">Editar
                                        <i class="material-icons left">edit</i>
                                    </a>
                                </td>

                                <td>
                                    <a href="#" id="form-emissora-delete" class="btn">Deletar
                                        <i class="material-icons left">delete</i>

                                        {{ Form::open(['method' => 'delete', 'route' => ['emissora.destroy', $emissora->id], 'id' => 'form-delete']) }}
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
