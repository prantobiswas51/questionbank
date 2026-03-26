<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class AiChatController extends Controller
{
    public function chat(Request $request)
    {
        $request->validate([
            'message' => 'required|string'
        ]);

        $message = $request->message;

        // Example using OpenAI-style API (replace with your actual endpoint/key)
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . env('OPENAI_API_KEY'),
        ])->post('https://api.openai.com/v1/chat/completions', [
            'model' => 'gpt-5-nano',
            'messages' => [
                ['role' => 'user', 'content' => $message]
            ],
        ]);

        return response()->json([
            'reply' => $response['choices'][0]['message']['content'] ?? 'No response'
        ]);
    }
}
