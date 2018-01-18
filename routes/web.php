<?php
//Pagina inicial
Route::get('/', function(){
    return view('index');
});

//Auth::routes();

Route::get('teste', function(){
    return view('teste');
});
Route::get('/teste2', function(){
    return view('teste2');
});


Route::get('ajax/comentarios-serie', 'ComentarioSerieController@index');
Route::get('ajax/atividades-serie', 'AtividadeController@atividadesSerie');


Route::get('serie/{slug}', 'SerieController@show')->name('show-serie');



//Funcoes estando logado
Route::group(['middleware' => ['auth']], function(){
    Route::post('comentario-serie/store', 'ComentarioSerieController@store');
    Route::delete('comentario-serie/delete/{id}', 'ComentarioSerieController@delete')->name('comentario-serie-delete');
    Route::post('comentario-serie/update/{id}', 'ComentarioSerieController@update');

    Route::post('avaliar/store', 'AvaliarController@store');

    Route::post('lista/store', 'ListaController@store');
    Route::get('usuario/listas', 'ListaController@listar');

    Route::get('ajax/listas/adicionar', 'ListaController@teste');
    Route::get('ajax/listas/remover_serie', 'ListaController@removerSerie');
    Route::get('ajax/listas/remover_lista', 'ListaController@removerLista');
    Route::get('ajax/listas/nome_lista', 'ListaController@nomeLista');

    //Deslogar
    Route::post('/logout', 'UserController@logout')->name('logout');
});

//Funcoes sem estar logado
Route::group(['middleware' => ['naoLogado']], function (){
    //Formulario login e cadastro
    Route::get('/login', function(){
        return view('login-cadastro');
    })->name('login');

    //Dados login
    Route::post('/login', 'UserController@login');

    //Dados cadastro
    Route::post('/cadastro', 'UserController@cadastro');

    //Login com facebook
    Route::get('/redirect', 'SocialAuthFacebookController@redirect');
    Route::get('/callback', 'SocialAuthFacebookController@callback');
});

//Painel administrativo admin
Route::group(['prefix' => 'admin', 'middleware' => 'blockUser'], function(){
    //Gerenciar generos
    Route::resource('genero', 'GeneroController');

    //Gerenciar emissoras
    Route::resource('emissora', 'EmissoraController');

    //Gerenciar series
    Route::resource('serie', 'SerieController');

    //Formulario config
    Route::get('config', function(){
        return view('admin.config-admin');
    })->name('admin-config');
    //Dados config
    Route::post('config', 'AdminController@config');
});
