<?php

namespace App\GPT\Chats\CustomerSupport;

use MalteKuhr\LaravelGPT\GPTChat;
use App\GPT\Actions\Letter\GenerateLetterGPTAction;

class LetterGPTChat extends GPTChat
{
    /**
     * The message which explains the assistant what to do and which rules to follow.
     *
     * @return string|null
     */
    public function systemMessage(): ?string
    {
        return "당신은 상황에 맞는 편지를 작성하는 전문가입니다. 
                주어진 상황과 관계, 작성자의 특성을 고려하여 진정성 있는 편지를 작성해주세요.";
    }

    /**
     * The functions which are available to the assistant. The functions must be
     * an array of classes (e.g. [new SaveSentimentGPTFunction()]). The functions
     * must extend the GPTFunction class.
     *
     * @return array|null
     */
    public function functions(): ?array
    {
        return [
            new GenerateLetterGPTAction()
        ];
    }

    /**
     * The function call method can force the model to call a specific function or
     * force the model to answer with a message. If you return with the class name
     * e.g. SaveSentimentGPTFunction::class the model will call the function. If
     * you return with false the model will answer with a message. If you return
     * with null or true the model will decide if it should call a function or
     * answer with a message.
     *
     * @return string|bool|null
     */
    public function functionCall(): string|bool|null
    {
        return GenerateLetterGPTAction::class;
    }
} 