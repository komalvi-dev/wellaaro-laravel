<?php

namespace App\Services;

use App\Models\ChatMessage;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Log;

class ChatAssistantService
{
    private const HISTORY_TURNS = 6;

    private const INTENT_KEYWORDS = [
        'quote', 'book', 'booking', 'price', 'pricing', 'appointment',
        'schedule', 'talk to', 'speak to', 'call me', 'reach out',
    ];

    public function __construct(
        private ChatContextBuilder $contextBuilder,
    ) {
    }

    public function ask(string $sessionId, string $message, ?string $ip = null): array
    {
        $priorMessages = ChatMessage::forSession($sessionId)
            ->orderByDesc('id')
            ->limit(self::HISTORY_TURNS)
            ->get()
            ->reverse()
            ->values();

        $context = $this->contextBuilder->build($message);

        $messages = [
            ['role' => 'system', 'content' => $this->buildSystemPrompt($context)],
        ];

        foreach ($priorMessages as $prior) {
            $messages[] = ['role' => $prior->role, 'content' => $prior->message];
        }

        $messages[] = ['role' => 'user', 'content' => $message];

        ChatMessage::create([
            'session_id' => $sessionId,
            'role' => 'user',
            'message' => $message,
            'ip_address' => $ip,
        ]);

        $reply = $this->callOpenAi($messages);

        ChatMessage::create([
            'session_id' => $sessionId,
            'role' => 'assistant',
            'message' => $reply,
            'ip_address' => $ip,
        ]);

        return [
            'reply' => $reply,
            'show_cta' => $this->detectIntent($message),
        ];
    }

    private function buildSystemPrompt(string $context): string
    {
        $prompt = <<<PROMPT
        You are the Wellaaro Assistant, a helpful guide on Wellaaro's medical tourism website, which helps international patients access affordable, high-quality treatment in India.

        Rules you must always follow:
        - Only state facts given to you in the "Relevant site content" section below. Never invent prices, success rates, hospital names, or other specifics that aren't provided.
        - Never give a medical diagnosis, treatment recommendation, or clinical advice. If asked something that requires medical judgment, say you can't advise on that and recommend they consult Wellaaro's medical team via the Get a Quote form or the Contact page.
        - If the visitor's question isn't covered by the content provided, say you don't have that specific information and suggest the Get a Quote form or Contact page for a personalized answer.
        - If the visitor expresses interest in booking, getting a price, or speaking to someone, encourage them to fill out the "Get a Free Quote" form.
        - Keep answers concise (2-4 sentences) and friendly.
        PROMPT;

        $prompt .= $context !== ''
            ? "\n\nRelevant site content:\n{$context}"
            : "\n\nNo matching site content was found for this question — be upfront about that.";

        return $prompt;
    }

    private function detectIntent(string $text): bool
    {
        $text = strtolower($text);

        foreach (self::INTENT_KEYWORDS as $keyword) {
            if (str_contains($text, $keyword)) {
                return true;
            }
        }

        return false;
    }

    private function callOpenAi(array $messages): string
    {
        $apiKey = config('services.openai.key');

        if (! $apiKey) {
            Log::warning('Chat assistant called without OPENAI_API_KEY configured.');

            return "Our chat assistant isn't available right now — please use the Get a Quote form or Contact page and our team will help directly.";
        }

        try {
            $response = (new Client())->post('https://api.openai.com/v1/chat/completions', [
                'headers' => [
                    'Authorization' => "Bearer {$apiKey}",
                    'Content-Type' => 'application/json',
                ],
                'json' => [
                    'model' => config('services.openai.model', 'gpt-4o-mini'),
                    'messages' => $messages,
                    'temperature' => 0.3,
                    'max_tokens' => 300,
                ],
                'timeout' => 15,
            ]);

            $body = json_decode($response->getBody()->getContents(), true);

            return trim($body['choices'][0]['message']['content'] ?? '')
                ?: "Sorry, I couldn't come up with an answer — please try rephrasing or use the Get a Quote form.";
        } catch (\Throwable $e) {
            Log::error('Chat assistant OpenAI call failed: '.$e->getMessage());

            return "Sorry, I'm having trouble responding right now — please try again shortly or use the Get a Quote form.";
        }
    }
}
