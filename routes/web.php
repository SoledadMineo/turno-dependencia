<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/{user?}', function ($user=null) {
    return view('welcome', ['user'=> $user] );
});

Route::get('/denuncia/{codigo}', function ($codigo) {
    return view('formulario');
});
