<?php

use App\GPT\Chats\CustomerSupport\CustomerSupportGPTChat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LetterController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
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

// 인증 관련 라우트
Route::group(['prefix' => 'auth'], function () {
    Route::post('login', [AuthController::class, 'login']);
    
    // 인증이 필요한 라우트
    Route::group(['middleware' => 'auth:api'], function () {
        Route::post('logout', [AuthController::class, 'logout']); // 로그아웃
        Route::get('me', [AuthController::class, 'me']); // 사용자 정보 조회
        Route::post('refresh', [AuthController::class, 'refresh']); // 토큰 갱신
    });
});

Route::prefix('users')->group(function () {
    Route::post('check-email', [UserController::class, 'checkEmail']);
    Route::post('register', [UserController::class, 'register']);
    // 인증이 필요한 라우트
    Route::middleware('auth:api')->group(function () {
        // 유저 관련 라우트
        Route::get('/', [UserController::class, 'index']);
        Route::patch('/{id}', [UserController::class, 'update']);
        Route::delete('/{id}', [UserController::class, 'destroy']);

        // 편지 관련 라우트
        Route::prefix('{userId}/letters')->group(function () {
            Route::get('/', [LetterController::class, 'index']);
            Route::post('/', [LetterController::class, 'create']);
            Route::delete('/{letterId}', [LetterController::class, 'destroy']);
        });

        // Example 라우트
        Route::get('/example', function() {
            $chat = CustomerSupportGPTChat::make();
            $chat->addMessage('I have a problem with your software.');
            $chat->send();
        
            return $chat->latestMessage()->content;
        });
    });
});