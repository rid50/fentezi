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
		
		config(['replyTo' => $request->get('email')]);
		
		//Mail::to(config('mail.to_who.address'))->send(new ContactEmail($contact));

		Mail::send('emails.contact', ['contact' => $contact], function ($message) {
			$message->replyTo(config('replyTo'));
			//$message->from('rdavidenko@gmail.com');
			$message->to(config('mail.to_who.address'));
			$message->bcc('rid50@mail.ru');
			$message->subject('Сообщение от пользователя Fentezi!');
		});
		
		return back()->with('success', 'Ваше сообщение успешно отправлено!'); 
	}
}
