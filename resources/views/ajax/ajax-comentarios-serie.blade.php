@foreach($comentarios as $comentario)
   <div class="col s12 comentario">
       @if(Auth::check() && Auth::user()->id == $comentario->user->id)
           <div class="gerenciar">
               <i class="material-icons edit-post" id="{{ $comentario->id }}">edit</i>
               <span id="form-comentario-serie-delete">
                   <i class="material-icons">delete</i>

                   {{ Form::open(['method' => 'delete', 'route' => ['comentario-serie-delete', $comentario->id], 'id' => 'form-delete']) }}
                   {{ Form::close() }}
               </span>
           </div>
       @endif

       @if($comentario->user->foto != null)
            <div class="img-perfil" style="background-image: url('/images/usuarios/{{ $comentario->user->id }}/{{ $comentario->user->foto }}');"></div>
       @else
            <div class="img-perfil sem-foto"><?php echo substr($comentario->user->nome, 0, 1); ?></div>
       @endif

       <div class="nome">
           {{ $comentario->user->nome }} {{ $comentario->user->sobrenome }}
           <span title="{{ date('d/m/Y H:i:s', strtotime($comentario->created_at)) }}">• {{ $comentario->user->tempoPost($comentario->created_at) }}</span>
       </div>

       <div class="descricao">
               {{ Form::open(['action' => ['ComentarioSerieController@update', $comentario->id], 'class' => 'form-comentario-serie-update show-hide ' . $comentario->id]) }}
                   {{ Form::textarea('descricao', $comentario->descricao, ['class' => 'materialize-textarea']) }}

                   <button class="btn right"><i class="material-icons right">send</i>Salvar</button>
               {{ Form::close() }}

           <div class="texto show-hide {{ $comentario->id }}">
               {{ $comentario->descricao }}
           </div>
       </div>
   </div>
@endforeach

{{ Form::hidden('contar_results', $contar_results, ['class' => 'contar_results']) }}

<div class="center-align">
    <button type="button" class="carregar-comentarios btn" data-page="{{ $offset }}">
        <i class="material-icons right">add_circle</i>
        Carregar
    </button>
</div>
