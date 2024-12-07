<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Facades\JWTAuth;
use MongoDB\BSON\ObjectId;

class UserController extends Controller
{
    public function checkEmail(Request $request)
    {
        $request->validate([
            'email' => 'required|email'
        ]);

        $exists = User::where('email', $request->email)->exists();

        return response()->json([
            'result' => 'success',
            'message' => $exists ? '이미 사용중인 이메일입니다.' : '사용 가능한 이메일입니다.',
            'available' => !$exists
        ]);
    }

    public function register(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);

        $user = User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => Hash::make($validatedData['password']),
        ]);

        return response()->json([
            'result' => 'success',
            'message' => '회원가입이 완료되었습니다.',
            'data' => $user
        ], 201);
    }

    // 사용자 목록 조회
    public function index()
    {
        $users = User::all();
        return response()->json([
            'result' => 'success',
            'message' => '사용자 목록 조회 성공',
            'data' => $users
        ]);
    }

    // 사용자 정보 수정
    public function update(Request $request, $id)
    {
        try {
            $user = User::findOrFail($id);

            $validatedData = $request->validate([
                'name' => 'string|max:255',
                'email' => 'string|email|max:255|unique:users,email,'.$user->_id,
                'password' => 'string|min:6|confirmed',
            ]);

            if (isset($validatedData['password'])) {
                $validatedData['password'] = Hash::make($validatedData['password']);
            }

            $user->fill($validatedData);
            $user->save();

            return response()->json([
                'result' => 'success',
                'message' => '사용자 정보 수정 성공',
                'data' => $user
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'result' => 'error',
                'message' => '사용자 정보 수정 중 오류가 발생했습니다.',
            ], 500);
        }
    }

    // 사용자 삭제
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return response()->json([
            'result' => 'success',
            'message' => '사용자 삭제 성공'
        ]);
    }
}