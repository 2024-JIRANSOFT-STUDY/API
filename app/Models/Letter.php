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
        'receiver',          // 받는 사람
        'situation',         // 상황 (생일, 결혼 등)
        'my_age',           // 작성자 나이
        'my_gender',        // 작성자 성별
        'friendly',         // 친근함 정도 (1-5)
        'essential_comment', // 필수 포함할 내용
        'tone_content',     // 말투 파일 내용 (선택)
        'generated_content', // 생성된 편지 내용
        'created_at'
    ];

    // 상황 목록 상수 정의
    const SITUATIONS = [
        'normal' => '일반적인 편지',
        'birthday' => '생일 축하',
        'marriage' => '결혼 축하',
        'obituary' => '부고',
        'employment' => '취업 축하',
        'graduate' => '졸업 축하',
        'entrance' => '입학 축하',
        'anniversary' => '기념일',
        'etc' => '기타'
    ];
} 