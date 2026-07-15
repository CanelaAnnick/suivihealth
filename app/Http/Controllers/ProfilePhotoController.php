<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfilePhotoController extends Controller
{
    public function update(Request $request)
    {
        $request->validate([
            'photo' => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $destination = public_path('uploads/photos');
        if (! is_dir($destination)) {
            mkdir($destination, 0777, true);
        }

        // Supprime l'ancienne photo si elle existe
        if (auth()->user()->photo && file_exists(public_path('uploads/'.auth()->user()->photo))) {
            unlink(public_path('uploads/'.auth()->user()->photo));
        }

        $file = $request->file('photo');
        $filename = uniqid('photo_').'.'.$file->getClientOriginalExtension();
        $file->move($destination, $filename);

        auth()->user()->update(['photo' => 'photos/'.$filename]);

        return back()->with('status', 'Photo de profil mise à jour.');
    }
}