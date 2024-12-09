<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Letter extends Model
{
    use SoftDeletes;
    
    protected $connection = 'mongodb';
    protected $collection = 'letters';

    protected $fillable = [
        // 필수 필드
        'user_id',          // 사용자 ID
        'receiver',         // 받는 사람
        'situation',        // 상황
        'my_age',           // 작성자 나이
        'my_gender',        // 작성자 성별
        'friendly',         // 친근함 정도
        'created_at',
        'updated_at',
        
        // 선택 필드 (null 가능)
        'title',            // 제목
        'essential_comment',// 필수 포함할 내용
        'tone_file',     // 말투 파일 내용
        'generated_content',// 생성된 편지 내용
        'deleted_at',
    ];

    protected $attributes = [
        'title' => null,
        'essential_comment' => null,
        'tone_file' => null,
        'generated_content' => null,
        'deleted_at' => null,
    ];

    public function getTitleAttribute($value)
    {
        return $value ?? '';
    }

    public function getEssentialCommentAttribute($value)
    {
        return $value ?? '';
    }

    public function getToneFileAttribute($value)
    {
        return $value ?? '';
    }

    public function getGeneratedContentAttribute($value)
    {
        return $value ?? '';
    }
    public function getDeletedAtAttribute($value)
    {
        return $value ?? '';
    }
    
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
} 