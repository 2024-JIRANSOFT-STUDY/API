<?php

namespace App\Http\Controllers;

use App\Models\Letter;
use Illuminate\Http\Request;
use App\GPT\Actions\Letter\LetterGPTAction;

class LetterController extends Controller
{
    // 특정 사용자의 편지 전체 조회
    public function index(Request $request, $userId)
    {
        $limit = $request->query('limit', 10);
        $pagination = filter_var($request->query('pagination', 'true'), FILTER_VALIDATE_BOOLEAN);
        $page = $request->query('page', 1);

        $query = Letter::where('user_id', $userId)->select('_id', 'title', 'created_at');

        if ($pagination) {
            $letters = $query->paginate($limit, ['*'], 'page', $page);

            // 페이지 유효성 검사
            if ($page < 1 || $page > $letters->lastPage()) {
                return response()->json([
                    'result' => 'error',
                    'message' => '유효하지 않은 페이지 번호입니다.'
                ], 400);
            }

            return response()->json([
                'limit' => $limit,
                'pagination' => $pagination,
                'total_page' => (int) $letters->lastPage(),
                'current_page' => (int) $letters->currentPage(),
                'next_page' => ($letters->currentPage() < $letters->lastPage() ? $letters->currentPage() + 1 : null),
                'previous_page' => ($letters->currentPage() > 1 ? $letters->currentPage() - 1 : null),
                'data' => $letters->items()
            ]);
        } else {
            $letters = $query->limit($limit)->get();
            return response()->json([
                'limit' => $limit,
                'pagination' => $pagination,
                'data' => $letters
            ]);
        }
    }

    public function create(Request $request, $userId)
    {
        $validatedData = $request->validate([
            'receiver' => 'required|string|max:50',
            'situation' => 'required|string',
            'my_age' => 'required|integer|min:1|max:120',
            'my_gender' => 'required|in:male,female',
            'friendly' => 'required|integer|min:1|max:5',
            'essential_comment' => 'nullable|string',
            'tone_file' => 'nullable|string'
        ]);

        try {
            $letter = Letter::create(array_merge($validatedData, [
                'user_id' => $userId
            ]));

            $response = LetterGPTAction::make($letter)->send('');

            return response()->json([
                'result' => 'success',
                'data' => $letter
            ], 201);
        } catch (\Exception $e) {
            \Log::error('An error occurred: ' . $e->getMessage(), [
                'exception' => $e,
            ]);
            return response()->json([
                'result' => 'error',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    // 편지 상세 조회
    public function show($userId, $letterId)
    {
        $letter = Letter::with('user')
            ->where('user_id', $userId)
            ->findOrFail($letterId);

        return response()->json([
            'status' => 'success',
            'letter' => $letter
        ]);
    }

    // 편지 삭제
    public function destroy($userId, $letterId)
    {
        $letter = Letter::where('user_id', $userId)
            ->where('_id', $letterId)
            ->firstOrFail();

        $letter->delete();

        return response()->json([
            'result' => 'success',
            'message' => '편지가 삭제되었습니다.'
        ]);
    }
    public function deleteAll($userId)
    {
        // 조건에 맞는 레코드를 한 번의 쿼리로 삭제
        $deletedRows = Letter::where('user_id', $userId)->delete();

        return response()->json([
            'result' => 'success',
            'message' => $deletedRows > 0
                ? '편지가 전체 삭제되었습니다.'
                : '삭제할 편지가 없습니다.'
        ]);
    }
}
