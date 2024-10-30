<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
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
// test translate working
//Route::get('translate',function (){
//    $lang=new GoogleTranslate('ar');
//    return $lang->setSource('ar')->setTarget('en')->translate('اهلا هاجر');
//});
Route::group(['middleware'=>'ChangeLang'],function (){
Route::post('/Register',RegisterController::class);
Route::post('/login',LoginController::class);
});

