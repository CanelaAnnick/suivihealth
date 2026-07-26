<?php

namespace App\Services;

use Prism\Prism\Facades\Prism;
use Prism\Prism\Enums\Provider;
use Prism\Prism\ValueObjects\Messages\UserMessage;
use Prism\Prism\ValueObjects\Messages\AssistantMessage;
use App\Models\ChatMessage;
use Illuminate\Support\Facades\Log;
class ChatbotService
{
    protected string $systemPrompt = "Tu es l'assistant virtuel de Medicare, une plateforme de télémédecine camerounaise. Réponds en français, de façon claire et bienveillante. Tu ne remplaces jamais un avis médical professionnel : oriente toujours vers une consultation avec un médecin pour tout diagnostic ou traitement.";

    public function envoyerMessage(int $userId, string $message): string
    {
        // Sauvegarde le message utilisateur
        ChatMessage::create([
            'user_id' => $userId,
            'role' => 'user',
            'contenu' => $message,
        ]);

        // Récupère l'historique récent pour le contexte multi-tours
        $historique = ChatMessage::where('user_id', $userId)
            ->orderBy('created_at')
            ->take(20)
            ->get();

       $messages = [];

foreach ($historique as $m) {

    if ($m->role === 'user') {
        $messages[] = new UserMessage($m->contenu);
    } else {
        $messages[] = new AssistantMessage($m->contenu);
    }

}
        try {
            $reponse = Prism::text()
                ->using(Provider::Groq, 'llama-3.3-70b-versatile')
                ->withSystemPrompt($this->systemPrompt)
                ->withMessages($messages)
                ->withClientRetry(3, 500) // 3 tentatives, 500ms entre chaque
                ->asText();

            $texte = $reponse->text;
        } catch (\Throwable $e) {
            Log::error('Erreur Prism/Groq chatbot: ' . $e->getMessage());
            $texte = "Désolé, je rencontre une difficulté technique en ce moment. Réessaie dans quelques instants.";
        }

        // Sauvegarde la réponse de l'assistant
        ChatMessage::create([
            'user_id' => $userId,
            'role' => 'assistant',
            'contenu' => $texte,
        ]);

        return $texte;
    }

    public function historique(int $userId)
    {
        return ChatMessage::where('user_id', $userId)
            ->orderBy('created_at')
            ->get();
    }
}
