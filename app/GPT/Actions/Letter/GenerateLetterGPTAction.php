<?php

namespace App\GPT\Actions\Letter;

use MalteKuhr\LaravelGPT\GPTAction;
use Closure;
use App\Models\Letter;

class GenerateLetterGPTAction extends GPTAction
{
    public function systemMessage(): ?string
    {
        return "당신은 상황에 맞는 편지를 작성하는 전문가입니다. 
                주어진 상황과 관계, 작성자의 특성을 고려하여 진정성 있는 편지를 작성해주세요.";
    }

    public function function(): Closure
    {
        return function (
            string $receiver,
            string $situation,
            int $myAge,
            string $myGender,
            int $friendly,
            string $essentialComment,
            ?string $toneContent = null
        ) {
            // GPT에게 전달할 프롬프트 구성
            $prompt = $this->createPrompt(
                $receiver,
                $situation,
                $myAge,
                $myGender,
                $friendly,
                $essentialComment,
                $toneContent
            );

            $response = $this->executePrompt($prompt);

            return $response;
        };
    }

    public function rules(): array
    {
        return [
            'receiver' => 'required|string|max:50',
            'situation' => 'required|string',
            'myAge' => 'required|integer|min:1|max:120',
            'myGender' => 'required|in:male,female',
            'friendly' => 'required|integer|min:1|max:5',
            'essentialComment' => 'required|string', 
            'toneContent' => 'nullable|string'
        ];
    }

    private function createPrompt(
        string $receiver,
        string $situation,
        int $myAge,
        string $myGender,
        int $friendly,
        string $essentialComment,
        ?string $toneContent
    ): string {
        $situationText = Letter::SITUATIONS[$situation] ?? '일반적인 편지';
        $gender = $myGender === 'male' ? '남성' : '여성';
        
        $prompt = "다음 정보를 바탕으로 자연스럽고 진정성 있는 편지를 작성해주세요:
                
                받는사람: {$receiver}
                상황: {$situationText}
                작성자 정보:
                - 나이: {$myAge}세
                - 성별: {$gender}
                친근함 정도: {$friendly}
                
                필수 포함할 내용: {$essentialComment}";

        if ($toneContent) {
            $prompt .= "\n\n다음 말투를 참고하여 작성해주세요:\n{$toneContent}";
        }

        return $prompt;
    }

    private function executePrompt(string $prompt)
    {
        return $this->send($prompt);
    }
} 