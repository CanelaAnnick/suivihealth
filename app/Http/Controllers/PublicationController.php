<?php

namespace App\Http\Controllers;

use App\Models\Publication;
use App\Models\Commentaire;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Support\Facades\Storage;

class PublicationController extends Controller
{
    public function index(): View
    {
        $publications = Publication::publiees()
            ->withCount('commentaires')
            ->with('auteur')
            ->latest()
            ->paginate(10);

        return view('communaute.index', compact('publications'));
    }

    public function afficher(Publication $publication): View
    {
        $publication->load(['auteur', 'commentaires.auteur']);

        return view('communaute.afficher', compact('publication'));
    }

    public function commenter(Request $request, Publication $publication): RedirectResponse
    {
        $request->validate([
            'contenu' => 'required|string|max:1000',
        ]);

        Commentaire::create([
            'publication_id' => $publication->id,
            'auteur_id' => auth()->id(),
            'contenu' => $request->contenu,
        ]);

        return back()->with('statut', 'Commentaire ajouté.');
    }

    public function creer(): View
    {
        return view('communaute.creer');
    }

    public function stocker(Request $request): RedirectResponse
    {
        \Log::info('Fichiers reçus:', $request->allFiles());
        \Log::info('hasFile media:', ['résultat' => $request->hasFile('media')]);

        $request->validate([
            'titre' => 'required|string|max:255',
            'contenu' => 'required|string',
            'categorie' => 'nullable|string|max:100',
            'media' => 'nullable|file|mimes:jpg,jpeg,png,webp,mp4,mov,avi|max:20480',
        ]);

        $mediaPath = null;
        $mediaType = null;

        if ($request->hasFile('media')) {
            $fichier = $request->file('media');
            \Log::info('Fichier détecté:', ['nom' => $fichier->getClientOriginalName(), 'taille' => $fichier->getSize()]);
            $mediaPath = $fichier->store('publications', 'public');
            \Log::info('Chemin stocké:', ['path' => $mediaPath]);
            $mediaType = str_starts_with($fichier->getMimeType(), 'video') ? 'video' : 'image';
        } else {
            \Log::warning('Aucun fichier média détecté dans la requête.');
        }

        Publication::create([
            'auteur_id' => auth()->id(),
            'titre' => $request->titre,
            'contenu' => $request->contenu,
            'categorie' => $request->categorie,
            'media_path' => $mediaPath,
            'media_type' => $mediaType,
            'statut' => 'publie',
        ]);

        return redirect()->route('communaute.index')->with('statut', 'Publication créée.');
    }

    public function supprimer(Publication $publication): RedirectResponse
    {
        abort_if(
            $publication->auteur_id !== auth()->id() && !in_array(auth()->user()->role, ['admin', 'superadmin']),
            403
        );

        if ($publication->media_path) {
            Storage::disk('public')->delete($publication->media_path);
        }

        $publication->delete();

        return redirect()->route('communaute.index')->with('statut', 'Publication supprimée.');
    }
}
