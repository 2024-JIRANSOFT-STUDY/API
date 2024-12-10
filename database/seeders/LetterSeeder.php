<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Letter;
use App\Models\User;

class LetterSeeder extends Seeder
{
    public function run()
    {
        // 첫 번째 사용자 가져오기
        $user = User::where('email', 'admin1@jiran.com')->first();

        if (!$user) {
            echo "No users found. Please seed users first.";
            return;
        }

        $situations = [
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

        $titles = [
            '일반적인 편지 제목',
            '생일 축하 제목',
            '결혼 축하 제목',
            '부고 제목',
            '취업 축하 제목',
            '졸업 축하 제목',
            '입학 축하 제목',
            '기념일 축하 제목',
            '기타 제목'
        ];

        $essentialComments = [
            '일반적인 편지 내용',
            '생일 축하 메시지',
            '결혼 축하 메시지',
            '부고 메시지',
            '취업 축하 메시지',
            '졸업 축하 메시지',
            '입학 축하 메시지',
            '기념일 축하 메시지',
            '기타 메시지'
        ];

        $generatedContents = [
            '안녕하세요, 오랜만에 소식을 전합니다. 잘 지내고 계신가요? 언제 한번 만나서 이야기 나누고 싶습니다.',
            '생일을 진심으로 축하드립니다! 올해도 건강하고 행복한 한 해가 되시길 바랍니다. 함께 축하할 수 있어 기쁩니다.',
            '결혼을 진심으로 축하드립니다! 두 분의 앞날에 행복과 사랑이 가득하길 기원합니다. 특별한 날 함께할 수 있어 영광입니다.',
            '깊은 애도를 표합니다. 이 어려운 시기에 마음의 평안을 찾으시길 바랍니다. 언제든지 도움이 필요하시면 말씀해 주세요.',
            '취업을 진심으로 축하드립니다! 새로운 직장에서의 성공을 기원합니다. 항상 응원하겠습니다.',
            '졸업을 진심으로 축하드립니다! 새로운 시작을 앞두고 있는 당신에게 무한한 가능성이 열려 있기를 바랍니다.',
            '입학을 진심으로 축하드립니다! 새로운 배움의 장에서 많은 것을 배우고 성장하길 바랍니다.',
            '기념일을 진심으로 축하드립니다! 함께한 시간들이 소중합니다. 앞으로도 많은 추억을 함께 만들어가길 바랍니다.',
            '다양한 일들 속에서도 항상 건강하고 행복하시길 바랍니다. 언제나 응원합니다.'
        ];

        $index = 0;
        foreach ($situations as $key => $situation) {
            Letter::create([
                'user_id' => $user->id,
                'receiver' => '홍길동' . ($index + 1),
                'situation' => $key,
                'my_age' => 25,
                'my_gender' => 'male',
                'friendly' => 3,
                'title' => $titles[$index],
                'essential_comment' => $essentialComments[$index],
                'generated_content' => $generatedContents[$index],
                'created_at' => now(),
                'updated_at' => now(),
                'deleted_at' => null,
            ]);
            $index++;
        }
    }
}