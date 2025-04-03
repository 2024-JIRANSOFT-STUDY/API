<?php

namespace App\GPT\Chats\CustomerSupport;

use OpenAI\Laravel\Facades\OpenAI;
use Illuminate\Support\Facades\Log;

class CustomerSupportGPTChat
{
    protected array $messages = [];
    protected array $functions = [];

    public function __construct()
    {
        $this->messages[] = [
            'role' => 'system',
            'content' => "당신은 친절하고 전문적인 고객 지원 담당자입니다.
                고객의 문의에 대해 정확하고 도움이 되는 답변을 제공해주세요.
                항상 한국어로 응답해주세요."
        ];
    }

    public function send(string $message)
    {
        try {
            $this->messages[] = [
                'role' => 'user',
                'content' => $message
            ];

            $response = OpenAI::chat()->create([
                'model' => 'gpt-3.5-turbo',
                'messages' => $this->messages,
                'functions' => $this->functions,
                'temperature' => 0.7,
                'max_tokens' => 1000,
            ]);

            $assistantMessage = $response->choices[0]->message;
            $this->messages[] = [
                'role' => 'assistant',
                'content' => $assistantMessage->content
            ];

            return $assistantMessage->content;
        } catch (\Exception $e) {
            Log::error('Customer support chat failed: ' . $e->getMessage());
            throw $e;
        }
    }

    public function addFunction(array $function)
    {
        $this->functions[] = $function;
    }

    public function clearHistory()
    {
        $this->messages = [
            [
                'role' => 'system',
                'content' => "당신은 친절하고 전문적인 고객 지원 담당자입니다.
                    고객의 문의에 대해 정확하고 도움이 되는 답변을 제공해주세요.
                    항상 한국어로 응답해주세요."
            ]
        ];
    }
}
