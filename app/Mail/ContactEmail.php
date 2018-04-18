<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ContactEmail extends Mailable
{
    use Queueable, SerializesModels;

	public $contact;	
	
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($contact)
    {
		$this->contact = $contact;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
		return $this
			//->to(config('mail.to_who.address'))
			->cc('rid50@mail.ru')
			//->from('rdavidenko@gmail.com')
			->subject('Сообщение от пользователя Fentezi!')
			->view('emails.contact');
    }
}
