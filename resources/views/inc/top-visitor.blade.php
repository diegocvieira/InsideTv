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
                     <li style="border-left: 2px solid #1c2936;"><a href="{{ route('login') }}"><i class="left material-icons">exit_to_app</i>Login / Cadastro</a></li>
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
        <li style="border-left: 2px solid #1c2936;"><a href="{{ route('login') }}"><i class="left material-icons">exit_to_app</i>Login / Cadastro</a></li>
    </ul>
</header>
