<?php

namespace App\Http\Controllers;

use App\GPT\Actions\Letter\GenerateLetterGPTAction;
use App\Http\Requests\GenerateLetterRequest;
use App\Models\Letter;
use Illuminate\Http\Request;

class LetterController extends Controller
{
    public function create(Request $request)
    {
        // 1. GenerateLetterGPTAction 인스턴스 생성
        $action = app(GenerateLetterGPTAction::class);

        // 2. 클로저 호출
        $function = $action->function();

        // 3. 요청 데이터 준비 및 클로저 호출
        $letter = $function(
            $request->input('receiver'),
            $request->input('situation'),
            $request->input('my_age'),
            $request->input('my_gender'),
            $request->input('friendly'),
            $request->input('essential_comment'),
            $request->input('tone_content')
        );

        // 4. 결과 처리
        return response()->json(['letter' => $letter]);
    }

    public function index()
    {
        $letters = Letter::where('created_at', '>=', now()->subDays(7))
        ->orderBy('created_at', 'desc')
        ->get();

        return response()->json($letters);
    }

    public function destroy(Request $request)
    {
        $letterId = $request->input('id');
    
        $letter = Letter::find($letterId);
    
        if (!$letter) {
            return response()->json(['success' => false, 'message' => 'Letter not found'], 404);
        }
    
        $letter->delete();
    
        return response()->json(['success' => true]);
    }
} 