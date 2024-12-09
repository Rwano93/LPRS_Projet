<?php

namespace App\Http\Controllers;

use App\Mail\HelloMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function showForm()
    {
        return view('contact.formulaire');
    }

    public function submit(Request $request)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'sujet' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        Mail::to('lprs.projet24@gmail.com')->send(new HelloMail($validated));

        return redirect()->route('contact.success');
    }

    public function success()
    {
        return view('contact.success');
    }
}

