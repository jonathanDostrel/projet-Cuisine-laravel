<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RecetteController;
use App\Http\Controllers\CommentaireController;

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

Route::get('/', [RecetteController::class, 'index']);

Route::resource('recette', RecetteController::class)->middleware('auth');

Route::resource('recette.commentaire', CommentaireController::class)->scoped([
    'commentaire' => 'id',
]);