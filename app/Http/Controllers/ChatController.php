<?php

namespace App\Http\Controllers;

use App\Services\ChatAssistantService;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ChatController extends Controller
{
    public function respond(Request $request, ChatAssistantService $assistant)
    {
        $validated = $request->validate([
            'message' => 'required|string|max:1000',
        ]);

        $sessionId = $request->session()->get('chat_session_id');

        if (! $sessionId) {
            $sessionId = (string) Str::uuid();
            $request->session()->put('chat_session_id', $sessionId);
        }

        $result = $assistant->ask($sessionId, $validated['message'], $request->ip());

        return response()->json($result);
    }
}
