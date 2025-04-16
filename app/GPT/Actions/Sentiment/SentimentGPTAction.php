<?php

namespace App\GPT\Actions\Sentiment;

use OpenAI\Laravel\Facades\OpenAI;
use Illuminate\Support\Facades\Log;

class SentimentGPTAction
{
    public function send(string $message)
    {
        try {
            $systemMessage = "당신은 텍스트의 감정을 분석하는 전문가입니다.
                주어진 텍스트의 감정을 분석하여 다음 형식으로 응답해주세요:

                감정(emotion): [주요 감정]
                강도(intensity): [1-10 사이의 숫자]
                설명(description): [감정 분석에 대한 설명]";

            $response = OpenAI::chat()->create([
                'model' => 'gpt-3.5-turbo',
                'messages' => [
                    ['role' => 'system', 'content' => $systemMessage],
                    ['role' => 'user', 'content' => $message]
                ],
                'temperature' => 0.3,
                'max_tokens' => 500,
            ]);

            $content = $response->choices[0]->message->content;

            // 감정, 강도, 설명 분리
            preg_match('/감정\(emotion\): (.*?)\n강도\(intensity\): (.*?)\n설명\(description\): (.*)/s', $content, $matches);

            if (count($matches) !== 4) {
                throw new \InvalidArgumentException('응답 형식이 올바르지 않습니다.');
            }

            return [
                'emotion' => trim($matches[1]),
                'intensity' => (int)trim($matches[2]),
                'description' => trim($matches[3])
            ];
        } catch (\Exception $e) {
            Log::error('Sentiment analysis failed: ' . $e->getMessage());
            throw $e;
        }
    }
}
