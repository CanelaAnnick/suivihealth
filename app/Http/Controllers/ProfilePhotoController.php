<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProfilePhotoController extends Controller
{
    public function update(Request $request)
    {
        $request->validate(['photo' => 'required|image|max:2048']);

        if (auth()->user()->photo) {
            Storage::disk('public')->delete(auth()->user()->photo);
        }

        $path = $request->file('photo')->store('photos', 'public');
        auth()->user()->update(['photo' => $path]);

        return back()->with('status', 'Photo de profil mise à jour.');
    }
}