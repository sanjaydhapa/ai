<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Ai\Agents\GeminiAssistant;

class AiController extends Controller
{
   public function index()
   {
       return view('ai.chat');
   }

    public function chat(Request $request)
    {
        $request->validate([
            'message' => ['required', 'string', 'max:5000'],
        ]);

        $agent = new GeminiAssistant();

        $response = $agent->prompt(
            $request->input('message')
        );

        return response()->json([
            'success' => true,
            'answer' => (string) $response,
        ]);
    }

}
