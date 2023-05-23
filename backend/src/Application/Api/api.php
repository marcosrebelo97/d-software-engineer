<?php

use App\Application\Api\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('users')->name('users.')->controller(UserController::class)->group(function(){
    Route::get('/','index')->name('index');
});


/*
-------------------------------------------------------------------
*/

Route::get('/users', [UserController::class, 'index']);
Route::post('/users', [UserController::class, 'store']);
Route::put('/users/{id}', [UserController::class, 'update']);


Route::get('/cep/{cep}', function (Request $request, $cep) {
    $state = 'AM';

    $client = new Client();
    $response = $client->request('GET', 'https://viacep.com.br/ws/'.$cep.'/json/');
    $data = json_decode($response->getBody(), true);

    // Verifica se o estado do CEP é diferente do estado permitido
    if ($data['uf'] !== $state) {
        return response()->json(['error' => 'CEP inválido para cadastro.'], 400);
    }

    return $data;
});
