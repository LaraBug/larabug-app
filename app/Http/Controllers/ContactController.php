<?php

namespace App\Http\Controllers;

use App\Mail\ContactEmail;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\ContactRequest;

class ContactController extends Controller
{
    public function contact()
    {
        return view('contact');
    }

    public function send(ContactRequest $request)
    {
        $request->merge([
            'ip' => $request->ip()
        ]);

        $data = $request->all();

        Mail::to('support@larabug.com')
            ->queue(new ContactEmail($data));

        return redirect()->route('contact')->withSuccess('Your contact message has been send. We will try to answer your message within 24 hours.');
    }
}
