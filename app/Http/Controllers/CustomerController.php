<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CustomerController extends Controller
{
    public function __constructor()
    {
        $this->middleware('auth');
    }

    public function index(Request $request) {
        return view('themes.tailwind.customers.index', [
            'contacts' => $request->user()->contacts,
        ]);
    }

    public function import() {
        return redirect()->route('customers')
            ->with(['message' => 'Import not completed !']);
    }

    public function show(Contact $contact) {
        $this->authorize('view', $contact);

        return view('themes.tailwind.contacts.show', [
            'show_contact' => $contact
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
            'last_name' => 'required|string|max:191',
            'first_name' => 'nullable|string|max:191',
            'phone' => 'required|string|max:15',
        ]);

        DB::beginTransaction();
        try {
            /** @var User $user */
            $user = $request->user();
            $contact = $user->contact;
            $data = $request->all();
            // Mettre à jour les informations de l'utilisateur si le contact existe
            if ($contact) {
                $contact->update($data);
            } else {
                // Creer le contact avec les informations de l'utilisateur
                $contact = new Contact($data);
                $contact->user_id = $user->id;
                $contact->save();
            }

            DB::commit();
            return redirect()
                ->route('contacts')
                ->with([
                    'success' => 'Contact updated successfully.',
                ]);
        } catch (Exception $exc) {
            DB::rollBack();

            return back()
                ->with([
                    'message' => $exc->getMessage(),
                    'error' => $exc->getMessage(),
                ]);
        }
    }
}
