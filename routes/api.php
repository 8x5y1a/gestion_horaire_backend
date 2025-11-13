<?php

use App\Http\Controllers\Auth\APIAuthController;
use App\Http\Controllers\Auth\Breeze\RegisteredUserController;
use App\Http\Resources\UserResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['middleware' => ['guest']], function(){
    Route::post('/login',[APIAuthController::class, 'login']);
    Route::post('/register', [RegisteredUserController::class, 'store']);
});

Route::group(['middleware' => ['auth:sanctum']], function (){

    Route::post('/logout',[APIAuthController::class, 'logout']);
    Route::get('/user', function (Request $request) { return new UserResource($request->user());});
    Route::apiResource('/blocheure', \App\Http\Controllers\BlocHeureController::class);
    Route::apiResource('/bloclibre', \App\Http\Controllers\BlocLibreController::class);
    Route::apiResource('/contrainte', \App\Http\Controllers\ContrainteController::class);
    Route::apiResource('/cours', \App\Http\Controllers\CoursController::class);
    Route::apiResource('/bloccours',\App\Http\Controllers\BlocCoursController::class);
    Route::apiResource('/groupecours', \App\Http\Controllers\GroupeCoursController::class);
    Route::apiResource('/local', \App\Http\Controllers\LocalController::class);
    Route::apiResource('/personnel', \App\Http\Controllers\PersonnelController::class);
    Route::apiResource('/cheminement',\App\Http\Controllers\CheminementController::class);
    Route::apiResource('/horaire',\App\Http\Controllers\HoraireController::class);
    Route::apiResource('/campus',\App\Http\Controllers\CampusController::class);

});

