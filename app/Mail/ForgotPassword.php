<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ForgotPassword extends Mailable
{
    use Queueable, SerializesModels;

    public $data,$email;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data,$email)
    {
        $this->data = str_replace(' ', '%20', asset('uploads/setting/' . $data->logo_path));
        $this->email = $email;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('aksoftware25@gmail.com', 'Fastkart.com')->subject('Forgot Password')->view('emails.password');
    }
}