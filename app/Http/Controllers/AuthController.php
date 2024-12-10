<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Log;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);
        
        $credentials = $request->only('email', 'password');
        if (!$token = JWTAuth::attempt($credentials)) {
            return response()->json([
                'result' => 'error',
                'message' => '이메일 또는 비밀번호가 일치하지 않습니다.'
            ], 401);
        }

        return $this->respondWithToken($token);
    }

    public function logout(Request $request)
    {
        try {
            JWTAuth::invalidate(JWTAuth::getToken());
            return response()->json([
                'result' => 'success',
                'message' => '로그아웃 성공'
            ]);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return response()->json([
                'result' => 'error',
                'message' => '로그아웃 처리 중 오류가 발생했습니다.'
            ], 500);
        }
    }

    public function me()
    {
        return response()->json([
            'result' => 'success',
            'message' => '사용자 정보 조회 성공',
            'user' => JWTAuth::user()
        ]);
    }

    public function refresh(Request $request)
    {
        try {
            $token = JWTAuth::getToken();
            if (!$token) {
                return response()->json([
                    'result' => 'error',
                    'message' => '토큰이 필요합니다.'
                ], 401);
            }
            
            $newToken = JWTAuth::refresh($token);
            return $this->respondWithToken($newToken);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return response()->json([
                'result' => 'error',
                'message' => '토큰 갱신에 실패했습니다.'
            ], 500);
        }
    }

    protected function respondWithToken($token)
    {
        return response()->json([
            'result' => 'success',
            'message' => '토큰이 발급되었습니다.',
            'data' => [
                'access_token' => $token,
                'token_type' => 'bearer',
                'expires_in' => JWTAuth::factory()->getTTL() * 60,
                'user_id' => (string) JWTAuth::user()->_id
            ]
        ]);
    }
} 