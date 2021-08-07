<?php

/** @var \Laravel\Lumen\Routing\Router $router */

use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Penjurusan;


/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->get('/testConnection', function () use ($router) {
    try {
        DB::connection()->getPdo();
        if(DB::connection()->getDatabaseName()){
            echo "Yes! Successfully connected to the DB: " . DB::connection()->getDatabaseName();
        }else{
            die("Could not find the database. Please check your configuration.");
        }
    } catch (\Exception $e) {
        die("Could not open connection to database server.  Please check your configuration.");
    }
});

$router->get('/user', function(){
    $users = User::all();
    // $users = DB::select('select * from users');
    return $users;
});
$router->get('/jurusan', function(){
    $jurusan = Penjurusan::all();
    return $jurusan;
});
$router->get('/users/{id}', function($id){
    $users = DB::select('select * from users where id = ?', [$id]);
    return $users;
});
$router->get('/jurusan/{id}', function($id){
    $users = DB::select('SELECT id, nama, email, foto, alamat, noTelp, sekolahAsal, namaOrtu, users.created_at, users.updated_at FROM `users` 
    JOIN detail_penjurusans ON id = detail_penjurusans.id_user AND detail_penjurusans.id_penjurusan = ?', [$id]);
    return $users;
});


$router->post('/user/register', 'AuthController@register');
$router->post('/user/login', 'AuthController@login');
$router->post('/user/update', 'AuthController@update');
$router->post('/user/delete', 'AuthController@delete');
$router->get('/user/checkExisting', 'AuthController@checkEmailRegistered');

$router->post('penjurusan/add', 'JurusanController@add');
$router->post('penjurusan/addDetail', 'JurusanController@addToDetail');

$router->post('/send_email' ,'AuthController@mail');

    

