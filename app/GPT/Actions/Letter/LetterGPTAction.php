<?php

namespace App\GPT\Actions\Letter;

use MalteKuhr\LaravelGPT\GPTAction;
use App\Models\Letter;
use Closure;

class LetterGPTAction extends GPTAction
{
    public function __construct(
        protected Letter $letter,
    ) {}

    /**
     * The message which explains the assistant what to do and which rules to follow.
     *
     * @return string|null
     */
    public function systemMessage(): ?string
    {
        $promptInfo = $this->buildPrompt();

        return "You are an expert letter writer who deeply understands Korean sentiment and culture.
                Please write sincere and touching letters appropriate for the given situation and relationship.

                {$promptInfo}

                Please strictly adhere to the following guidelines:

                1. Tone Setting According to Familiarity Level (1-5):
                    - 1: Very formal and polite tone (e.g., “~님께”, “~드립니다”, “~올립니다”)
                    - 2: Formal but slightly friendly tone (e.g., “~님께”, “~드려요”, “~합니다”)
                    - 3: Friendly and soft tone (e.g., “~님”, “~해요”, “~이에요”)
                    - 4: Comfortable and familiar tone (e.g., “~야/~아”, “~해”, “~이야”)
                    - 5: Very intimate tone (e.g., “~야/~아”, informal language, emoticon usage allowed)

                2. Reflecting Korean Sentiment:
                    - Use honorifics or informal language based on age difference
                    - Use appropriate Korean idioms and expressions
                    - Express respectfulness and sincerity
                    - Choose vocabulary suitable for the recipient’s generation

                Write in the following format:

                Title: [A distinctive title that captures the situation and emotion]
                ---
                Content: [Recipient’s Title (reflecting the relationship and familiarity level)]

                [Paragraph 1: Greeting and reason for writing the letter]
                [Paragraph 2: Specific details and heartfelt message]
                [Paragraph 3: Future wishes or promises]
                [Paragraph 4: Closing message]

                [Sincerely, Sender’s Name (appropriate signature)]";
    }

    public function description(): string
    {
        return "This function generates a letter tailored to the given information and situation.";
    }

    /**
     * Specifies the function to be invoked by the model. The function is implemented as a
     * Closure which may take parameters that are provided by the model. If extra arguments
     * are included in the documentation to optimize model's performance (by allowing it more
     * thinking time), these can be disregarded by not including them within the Closure
     * parameters.
     *
     * @return Closure
     */
    public function function(): Closure
    {
        return function (string $title, string $content): mixed {
            $this->letter->title = $title;
            $this->letter->generated_content = $content;
            $this->letter->save();

            return [
                'title' => $title,
                'content' => $content
            ];
        };
    }

    /**
     * Defines the rules for input validation and JSON schema generation. Override this
     * method to provide custom validation rules for the function. The documentation will
     * have the same order as the rules are defined in this method.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'title' => 'required|string|max:100',
            'content' => 'required|string|min:500|max:1000'
        ];
    }

    public function temperature(): ?float
    {
        return env('OPENAI_API_TEMPPERATURE', 1);
    }

    protected function buildPrompt(): string
    {
        $user = $this->letter->user;

        $prompt = "=== Letter Writing Information ===\n";
        $prompt .= "1. Basic Information:\n";
        $prompt .= "- Sender's Name: {$user->name}\n";
        $prompt .= "- Recipient: {$this->letter->receiver}\n";
        $prompt .= "- Situation: {$this->letter->situation}\n";
        $prompt .= "- Sender's Age: {$this->letter->my_age} years old\n";
        $prompt .= "- Sender's Gender: " . ($this->letter->my_gender == 'male' ? 'Male' : 'Female') . "\n";
        $prompt .= "- Familiarity Level: {$this->letter->friendly} points (1 to 5)\n\n";

        $prompt .= "2. Additional Information:\n";
        if ($this->letter->essential_comment) {
            $prompt .= "- Required Content to Include: {$this->letter->essential_comment}\n";
        }
        if ($this->letter->tone_file) {
            $prompt .= "- Tone Setting: {$this->letter->tone_file}\n";
        }

        return $prompt;
    }
}
