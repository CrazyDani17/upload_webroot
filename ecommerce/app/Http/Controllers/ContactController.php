<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use Mail;
use App\Mail\ContactMail;

class ContactController extends Controller
{
    public function contact_form()
    {
        return view('Contact.form');
    }

    public function send_mail(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'subject' => 'required',
            'body' => 'required'
        ]);
        Mail::to($request->email)->send(new ContactMail($request));
        return back()->with('alert', 'Your mail has been sent');
    }

}