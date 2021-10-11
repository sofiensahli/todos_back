<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UtilisController ; 
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

Route::get('/', function () {
    return view('welcome');
});



Route::post('/sign_up',  [UtilisController::class, 'sign_up']);
Route::post('/sign_in', [UtilisController::class, 'sign_in']);
Route::post ('/newcategories' ,  [UtilisController::class ,'newCategories']);
Route::post ('/newtod' ,  [UtilisController::class ,'newTod']);
Route::post ('/updatetod' ,  [UtilisController::class ,'updateTod']);
Route::post ('/deletetodo' ,  [UtilisController::class ,'deletetodo']);