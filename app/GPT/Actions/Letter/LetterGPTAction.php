<?php

namespace App\GPT\Actions\Letter;

use App\Models\Letter;
use Illuminate\Support\Facades\Log;
use InvalidArgumentException;
use OpenAI\Laravel\Facades\OpenAI;

class LetterGPTAction
{
    public function __construct(
        protected Letter $letter,
    ) {}

    public static function make(Letter $letter): self
    {
        return new self($letter);
    }

    public function send(string $message)
    {
        try {
            $promptInfo = $this->buildPrompt();

            $systemMessage = "당신은 한국의 정서와 문화를 깊이 이해하는 편지 작성 전문가입니다.
                주어진 상황과 관계에 맞는 진정성 있고 감동적인 편지를 작성해주세요.

                {$promptInfo}

                다음 사항을 반드시 지켜주세요:

                1. 친근도(1-5)에 따른 말투 설정:
                   - 1: 매우 격식있고 예의바른 말투 (예: '~님께', '~드립니다', '~올립니다')
                   - 2: 격식있지만 약간의 친근함 포함 (예: '~님께', '~드려요', '~합니다')
                   - 3: 친근하고 부드러운 말투 (예: '~님', '~해요', '~이에요')
                   - 4: 편안하고 친근한 말투 (예: '~야/~아', '~해', '~이야')
                   - 5: 매우 친밀한 말투 (예: '~야/~아', 반말, 이모티콘 사용 가능)

                2. 상황별 필수 요소:
                   - 결혼: 축하, 행복한 가정, 사랑, 미래에 대한 축복
                   - 생일: 축하, 건강, 행복, 감사, 추억
                   - 감사: 구체적인 감사 이유, 진심어린 마음 표현
                   - 위로: 공감, 응원, 희망적인 메시지
                   - 사과: 진심어린 사과, 반성, 개선 의지

                3. 편지 길이:
                   - 최소 200자 이상
                   - 3~4개 문단으로 구성
                   - 각 문단은 자연스럽게 연결

                4. 한국적 정서 반영:
                   - 나이 차이를 고려한 존댓말/반말 사용
                   - 적절한 한국어 관용구와 표현 활용
                   - 정중하면서도 진정성 있는 표현 사용
                   - 세대에 맞는 어휘 선택

                반드시 다음 형식으로 작성해주세요:

                제목(title): [상황과 감정을 잘 담은 개성있는 제목]
                ---
                내용(content):[받는 사람 호칭 (관계와 친근도 반영)]

                [1번 문단: 인사말과 편지를 쓰게 된 계기]
                [2번 문단: 구체적인 내용과 진심어린 메시지]
                [3번 문단: 앞으로의 바람이나 약속]
                [4번 문단: 마무리 인사]

                [보내는 사람 (작성자의 이름에 맞는 서명)]";

            $response = OpenAI::chat()->create([
                'model' => 'gpt-3.5-turbo',
                'messages' => [
                    ['role' => 'system', 'content' => $systemMessage],
                    ['role' => 'user', 'content' => $message]
                ],
                'temperature' => 0.7,
                'max_tokens' => 2000,
            ]);

            $content = $response->choices[0]->message->content;

            // 제목과 내용 분리
            preg_match('/제목\(title\): (.*?)\n---\n내용\(content\):(.*)/s', $content, $matches);

            if (count($matches) !== 3) {
                throw new InvalidArgumentException('응답 형식이 올바르지 않습니다.');
            }

            $title = trim($matches[1]);
            $content = trim($matches[2]);

            $this->letter->title = $title;
            $this->letter->generated_content = $content;
            $this->letter->save();

            return [
                'title' => $title,
                'content' => $content
            ];
        } catch (\Exception $e) {
            Log::error('Letter generation failed: ' . $e->getMessage());
            throw $e;
        }
    }

    protected function buildPrompt(): string
    {
        return "받는 사람: {$this->letter->receiver}
                상황: {$this->letter->situation}
                작성자 나이: {$this->letter->my_age}세
                작성자 성별: {$this->letter->my_gender}
                친근도: {$this->letter->friendly}
                필수 포함 내용: {$this->letter->essential_comment}
                말투 파일: {$this->letter->tone_file}";
    }
}
