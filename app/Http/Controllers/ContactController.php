<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactEmail;
use App\Http\Requests\ContactFormRequest;

class ContactController extends Controller
{
    public function getForm()
    {
        return view('contact.getform');
    }

	public function send(ContactFormRequest $request)
	{
		$contact = [];

		$contact['name'] = $request->get('name');
		$contact['email'] = $request->get('email');
		$contact['msg'] = $request->get('msg');

		Mail::to(config('mail.to_who.address'))->send(new ContactEmail($contact));

		return back()->with('success', 'Ваше сообщение успешно отправлено!'); 
	}
}
