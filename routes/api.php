<?php

use App\GPT\Chats\CustomerSupport\CustomerSupportGPTChat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LetterController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::get('/example', function() {
    $chat = CustomerSupportGPTChat::make();
    $chat->addMessage('I have a problem with your software.');
    $chat->send();

    return $chat->latestMessage()->content;
});


Route::prefix('letters')->group(function () {
    Route::get('/', [LetterController::class, 'index']);
    Route::post('/create', [LetterController::class, 'create']);
    Route::delete('/{id}', [LetterController::class, 'destroy']);
});