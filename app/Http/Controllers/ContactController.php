<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactFormMail;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class ContactController extends Controller
{
    /**
     * Show the contact form.
     *
     * @return View
     */
    public function show(): View
    {
        return view('contact.formulaire');
    }

    /**
     * Handle the contact form submission.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function submit(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'sujet' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        $contact = Contact::create($validated);

        try {
            Mail::to(config('mail.admin_address'))->send(new ContactFormMail($contact));
            Log::info('E-mail envoyé avec succès', ['contact_id' => $contact->id]);
        } catch (\Exception $e) {
            Log::error('Erreur lors de l\'envoi de l\'e-mail', [
                'erreur' => $e->getMessage(),
                'contact_id' => $contact->id
            ]);
            return redirect()->route('contact.show')->with('error', 'Une erreur est survenue lors de l\'envoi de votre message. Veuillez réessayer plus tard.');
        }

        return redirect()->route('contact.confirmation')->with('status', 'Votre message a été envoyé avec succès !');
    }

    /**
     * Show the confirmation page after sending the message.
     *
     * @return View
     */
    public function confirmation(): View
    {
        return view('contact.confirmation');
    }
}