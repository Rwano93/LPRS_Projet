<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactFormMail;
use Illuminate\Support\Facades\Log;

class ContactController extends Controller
{
    public function show()
    {
        return view('contact.formulaire');
    }

    public function submit(Request $request)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'sujet' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        $contact = Contact::create($validated);

        try {
            Mail::to('admin@example.com')->send(new ContactFormMail($contact));
            Log::info('E-mail envoyé avec succès', ['contact_id' => $contact->id]);
        } catch (\Exception $e) {
            Log::error('Erreur lors de l\'envoi de l\'e-mail', ['error' => $e->getMessage(), 'contact_id' => $contact->id]);
        }

        return redirect()->route('contact.confirmation')->with('status', 'Votre message a été envoyé avec succès !');
    }

    public function confirmation()
    {
        return view('contact.confirmation');
    }
}