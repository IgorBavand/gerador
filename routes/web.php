<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//Route::get('/', 'SysController@index');

Route::resources([
    'questao' => 'SysController',
    //'gerar' => 'HomeController',
]);

Auth::routes();

Route::get('/', 'AuthController@painel')->name('admin');
Route::get('/home', 'AuthController@painel')->name('home');
Route::get('/home/Formlogin', 'AuthController@Formlogin')->name('admin.Formlogin');
Route::post('/home/logout', 'AuthController@sair')->name('admin.logout');
Route::post('/admin/login/do', 'AuthController@login')->name('admin.login.do');



//Route::post('/gerar', 'HomeController@gerarAvaliacao')->name('gerar');


Route::match(['GET','POST'], '/gerar', 'HomeController@gerarAvaliacao');



Route::get('/download_gabarito', 'HomeController@download_gabarito')->name('download_gabarito');
Route::get('/download_prova', 'HomeController@download_prova')->name('download_prova');
Route::get('formCadastrarQuestao', 'HomeController@formCadastroQuestao')->name('cadastrar_questao');
Route::get('/editar/usuario/{id}', 'HomeController@formUpdate')->name('admin.editar.usuario');
Route::get('visualizar/minhas/questoes/{id}', 'HomeController@minhas_questoes')->name('minhas_questos');
Route::get('visualizar/minhas/questoes/{id}/{id_q}', 'HomeController@visualizar_questao')->name('visualizar_questao');

Route::put('edit-sub/{id_quest}/{id_sub}', 'HomeController@edit_sub')->name('edit_sub');
Route::put('edit-alt/{id_quest}/{id1}/{id2}/{id3}/{id4}', 'HomeController@edit_alt')->name('edit_alt');
//Route::get('/', 'HomeController@index')->name('home');