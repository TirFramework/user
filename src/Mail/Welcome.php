<?php

namespace Tir\User\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use Tir\Crud\Support\Facades\Crud;
use Tir\Setting\Facades\Stg;

class Welcome extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    private $firstName;
    public $heading;
    public $text;

    /**
     * Create a new instance.
     *
     * @param string $firstName
     * @return void
     */
    public function __construct($firstName)
    {
        $this->firstName = $firstName;
        $this->heading = trans('user::mail.welcome', ['name' => $firstName]);
        $this->text = trans('user::mail.account_created');
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject(trans('user::mail.welcome', ['name' => $this->firstName]))
            ->view("emails.{$this->getViewName()}", [
                'logo' => Stg::get('storefront_mail_logo'),
            ]);
    }

    private function getViewName()
    {
        return 'text' . (Crud::is_rtl() ? '_rtl' : '');
    }
}
