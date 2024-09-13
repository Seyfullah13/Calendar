<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ContactsController extends Controller
{
    public function index() {
        return view('themes.tailwind.contacts.index', [
            'contacts' => Auth::user()->contact->contacts()
        ]);
    }

    public function show(Contact $contact) {
        $this->authorize('view', $contact);

        return view('themes.tailwind.contacts.show', [
            'shown_contact' => $contact
        ]);
    }

    public function complete()
    {
        return view('themes.tailwind.contacts.complete-contact');
    }

    public function update(Request $request)
    {
        // Valider les données entrantes
        $request->validate([
            'name' => 'required|string|max:191',
            'phone' => 'required|string|max:15',
        ]);

        // Récupérer l'utilisateur authentifié
        $user = Auth::user();

        // Mettre à jour les informations de l'utilisateur
        $user->name = $request->input('name');
        $user->phone = $request->input('phone');
        $user->save();
        

        return redirect()->route('properties')->with('success', 'Profile updated successfully');    }
}
