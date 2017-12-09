<?php
Route::get('/', function(){
    return view('index');
});

//Auth::routes();




Route::get('/login-cadastro', function(){
    return view('login-cadastro');
})->name('login-cadastro');

Route::post('/login', 'UserController@login');
Route::post('/cadastro', 'UserController@cadastro');

Route::post('/logout', 'UserController@logout')->name('logout');

//Login com facebook
Route::get('/redirect', 'SocialAuthFacebookController@redirect');
Route::get('/callback', 'SocialAuthFacebookController@callback');


//Painel administrativo
Route::group(['prefix' => 'admin', 'middleware' => 'blockUser'], function(){
    Route::resource('genero', 'GeneroController');
    Route::resource('emissora', 'EmissoraController');
    Route::resource('serie', 'SerieController');
});
