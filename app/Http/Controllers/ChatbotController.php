<?php

namespace App\Http\Controllers;

use App\Services\ChatbotService;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\JsonResponse;

class ChatbotController extends Controller
{
    public function __construct(protected ChatbotService $chatbotService) {}

   public function index(): View
{
    $messages = $this->chatbotService->historique(auth()->id());

    return view('chatbot.index', compact('messages'));
}

    public function envoyer(Request $request): JsonResponse
    {
        $request->validate([
            'message' => 'required|string|max:2000',
        ]);

        $reponse = $this->chatbotService->envoyerMessage(
            auth()->id(),
            $request->message
        );

        return response()->json(['reponse' => $reponse]);
    }
}
