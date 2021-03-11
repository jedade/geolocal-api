<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProblemController;
use App\Http\Controllers\ArrondissementController;
use App\Http\Controllers\CommuneController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CommentController;
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
// user controller routes
Route::post("register", [UserController::class, "register"]);

Route::post("login", [UserController::class, "login"]);



// sanctum auth middleware routes
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['middleware' => 'auth:sanctum'], function(){

    Route::get("/users", [UserController::class, "users"]);
    Route::get("/user/{id}", [UserController::class, "users_info"]);
    Route::patch("/user/{id}", [UserController::class, "update"]);
    Route::delete("/user/{id}", [UserController::class, "destroy"]);
    //route problemes
    Route::patch('problemes/{id?}', [ProblemController::class,'update']);
    Route::delete('problemes/{id?}', [ProblemController::class,'destroy']);
    //route category
    Route::post('categories/', [CategoryController::class,'create']);
    Route::put('categories/{id?}', [CategoryController::class,'update']);
    Route::delete('categories/{id?}', [CategoryController::class,'destroy']);

    //route communes
    Route::delete('communes/{id?}', [CommuneController::class,'destroy']);
    Route::post('communes/', [CommuneController::class,'create']);
    Route::put('communes/{id?}', [CommuneController::class,'update']);
    

    //route Arrondissement
    
    Route::put('arrondissements/{id?}', [ArrondissementController::class,'update']);
    Route::delete('arrondissements/{id?}', [ArrondissementController::class,'destroy']);

    //route commentaires
});
Route::post('arrondissements/', [ArrondissementController::class,'create']);
Route::middleware('auth:api')->group(function() {

    //Route::resource('problems', ProblemController::class, 'problems');

});



//Route api pour les problems
Route::get('problemes/', [ProblemController::class,'listall']);
Route::get('problemes/{id}', [ProblemController::class,'list']);
Route::get('problemes/users/{users}', [ProblemController::class,'search_users']);
Route::get('problemes/commune/{id}', [ProblemController::class,'search_commune']);
Route::get('problemes/category/{id}', [ProblemController::class,'search_category']);
Route::post('problemes/', [ProblemController::class,'create']);




//Route api pour les Arrondissement
Route::get('arrondissements/', [ArrondissementController::class,'listall']);

Route::get('arrondissements/{id}', [ArrondissementController::class,'list']);

Route::get('arrondissements/search/{name}', [ArrondissementController::class,'search']);






//Route api pour les Category
Route::get('categories/', [CategoryController::class,'listall']);

Route::get('categories/{id}', [CategoryController::class,'list']);

Route::get('categories/search/{name}', [CategoryController::class,'search']);






//Route api pour les Comment
Route::get('comments/', [CommentController::class,'listall']);

Route::get('comments/{id}', [CommentController::class,'list']);

Route::get('comments/{name}', [CommentController::class,'search']);
Route::get('comments/problemes/{id}', [CommentController::class,'search_problemes']);
Route::post('comments/', [CommentController::class,'create']);
Route::put('comments/{id?}', [CommentController::class,'update']);
Route::delete('comments/{id?}', [CommentController::class,'destroy']);



//Route api pour les Commune
Route::get('communes/', [CommuneController::class,'listall']);

Route::get('communes/{id}', [CommuneController::class,'list']);

Route::get('communes/search/{name}', [CommuneController::class,'search']);


