<?php

Route::get('/' , function() {
    return view('welcome');
}
);

Route::get('/zoeken', [
    'uses' => 'ZoekController@PostZoeken',
    'as' => 'autozooi.zoek',
    'middleware' => 'auth'
]);
Route::get('/add-to-lijst/{id}', [
    'uses' => 'ZoekController@getAddToLijst',
    'as' => 'product.addToLijst',
    'middleware' => 'auth'
])->where('id', '(.*)');
Route::get('/remove/{id}', [
    'uses' => 'ZoekController@getRemoveItem',
    'as' => 'product.remove'
]);
Route::get('/removeFactuur/{id}', [
    'uses' => 'ZoekController@getRemoveFactuur',
    'as' => 'autozooi.removeFactuur'
]);
Route::get('/lijst', [
    'uses' => 'ZoekController@getLijst',
    'as' => 'autozooi.lijst',
    'middleware' => 'auth'
]);
Route::post('/lijst', [
    'uses' => 'ZoekController@postLijst',
    'as' => 'autozooi.lijst',
    'middleware' => 'auth'
]);

Route::get('/factuur', [
    'uses' => 'ZoekController@getFactuur',
    'as' => 'autozooi.factuur',
    'middleware' => 'auth'
]);

Route::post('/factuur', [
    'uses' => 'ZoekController@postFactuur',
    'as' => 'autozooi.factuur',
    'middleware' => 'auth'
]);

Route::post('/test', [
    'uses' => 'ZoekController@postTest',
    'as' => 'autozooi.test',
    'middleware' => 'auth'
]);

Route::get('/klantSelect', [
    'uses' => 'ZoekController@getKlantSelect',
    'as' => 'autozooi.klantSelect',
    'middleware' => 'auth'
]);

Route::get('/wijzigKlant', [
    'uses' => 'ZoekController@wijzigKlant',
    'as' => 'autozooi.wijzigKlant',
    'middleware' => 'auth'
]);

Route::get('/wijzigKlant', [
    'uses' => 'ZoekController@wijzigKlant',
    'as' => 'autozooi.wijzigKlant',
    'middleware' => 'auth'
]);

Route::get('/facturen', [
    'uses' => 'ZoekController@getFacturen',
    'as' => 'autozooi.facturen',
    'middleware' => 'auth'
]);

Route::get('/succes', [
    'uses' => 'ZoekController@getSucces',
    'as' => 'autozooi.succes',
    'middleware' => 'auth'
]);

Route::get('/klanten', [
    'uses' => 'ZoekController@getKlanten',
    'as' => 'autozooi.klanten',
    'middleware' => 'auth'
]);

Route::get('/generate-pdf', [
    'uses' => 'HomeController@generatePDF',
    'middleware' => 'auth'
    ]);

Auth::routes();


