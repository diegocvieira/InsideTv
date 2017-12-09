<header id="header-visitor">
    <div class="navbar-fixed">
        <nav>
            <div class="nav-wrapper">
                <a href="/" class="brand-logo left">
                    <img src="{{ asset('images/insidetv-logo.png') }}">
                </a>

                <a href="#" data-activates="mobile-demo" class="button-collapse right"><i class="material-icons">menu</i></a>

                {{ Form::open(['role' => 'search', 'class' => 'search']) }}
                    <div class="input-field filter">
                        {{ Form::select('filtro', ['all' => 'Tudo', 'series' => 'Séries', 'usuarios' => 'Usuários', 'forum' => 'Fórum'], 'all', ['class' => 'search-filter']) }}
                    </div>

                    <div class="input-field palavra-chave">
                        {{ Form::input('text', 'busca') }}
                        {{ Form::label('busca', 'Busque por Séries, usuários e tópicos') }}
                    </div>

                    <button type="submit"><i class="material-icons">search</i></button>
                {{ Form::close() }}

                <ul class="right hide-on-med-and-down menu">
                     <li><a href="{{ route('serie.index') }}"><i class="left material-icons">theaters</i>Séries</a></li>
                     <li><a href="#"><i class="left material-icons">forum</i>Fórum</a></li>
                     <li style="border-left: 2px solid #1c2936;"><a href="{{ route('login-cadastro') }}"><i class="left material-icons">exit_to_app</i>Login / Cadastro</a></li>
                 </ul>
            </div>
         </nav>
     </div>

    <ul class="side-nav" id="mobile-demo">
        {{ Form::open(['class' => 'search', 'role' => 'search']) }}
            <div class="input-field">
                {{ Form::select('filtro', ['all' => 'Tudo', 'series' => 'Séries', 'usuarios' => 'Usuários', 'forum' => 'Fórum'], 'all', ['class' => 'search-filter']) }}
            </div>

            <div class="input-field palavra-chave">
                {{ Form::input('text', 'busca', null, ['class' => 'palavra-chave']) }}
                {{ Form::label('busca', 'Busque por Séries, usuários e tópicos') }}
                <button type="submit"><i class="material-icons">search</i></button>
            </div>
        {{ Form::close() }}

        <li><a href="/"><i class="left material-icons">home</i>Home</a></li>
        <li><a href="{{ route('serie.index') }}"><i class="left material-icons">theaters</i>Séries</a></li>
        <li><a href="#"><i class="left material-icons">forum</i>Fórum</a></li>
        <li style="border-left: 2px solid #1c2936;"><a href="{{ route('login-cadastro') }}"><i class="left material-icons">exit_to_app</i>Login / Cadastro</a></li>
    </ul>
</header>

<script>
    $(document).ready(function(){
        $("#header-visitor .button-collapse").sideNav();
        $('#header-visitor select').material_select();
    });

    $(document).on('click', '#header-visitor form button', function(){
        if($('.palavra-chave').val() == '')
            return false;

        else
            return true;
    });

    $(document).on('change', '.search-filter', function(){
        var value = $(this).val();
        var tag = $('#header-visitor .palavra-chave label');

        switch(value){
            case 'usuarios':
                tag.html('Busque por usuários');
                break;

            case 'series':
                tag.html('Busque por séries');
                break;

            case 'forum':
                tag.html('Busque por tópicos no forum');
                break;

            case 'all':
                tag.html('Busque por Séries, usuários e tópicos');
        }
    });
</script>
