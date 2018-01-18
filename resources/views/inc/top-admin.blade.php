<header id="header-admin">
    <div class="navbar-fixed">
        <nav>
            <div class="nav-wrapper">
                <a href="/" class="brand-logo left">
                    <img src="{{ asset('images/insidetv-logo.png') }}">
                </a>

                <a href="#" data-activates="mobile-demo" class="button-collapse right"><i class="material-icons right">arrow_drop_down</i>Administrador</a>

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

        <li style="margin-top: 20px;"><a href="/"><i class="left material-icons">dashboard</i>Painel de controle</a></li>
        <li><a href="{{ route('serie.index') }}"><i class="left material-icons">local_movies</i>Séries</a></li>
        <li><a href="#"><i class="left material-icons">forum</i>Fórum</a></li>
        <li><a href="{{ route('genero.index') }}"><i class="left material-icons">movie_filter</i>Gêneros</a></li>
        <li><a href="{{ route('emissora.index') }}"><i class="left material-icons">live_tv</i>Emissoras</a></li>
        <li><a href="#"><i class="left material-icons">star</i>Conquistas</a></li>
        <li style="border-top: 2px solid #1c2936;"><a href="{{ route('admin-config') }}"><i class="left material-icons">account_circle</i>Configurações</a></li>
        <li>
            <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="left material-icons">exit_to_app</i>Sair</a>
            {{ Form::open(['route' => 'logout', 'id' => 'logout-form', 'style' => 'display:none;']) }}
            {{ Form::close() }}
        </li>
    </ul>
</header>
