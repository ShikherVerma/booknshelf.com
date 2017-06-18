<?php

namespace App\Listeners;

use Mail;
use App\Events\UserRegistered;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Contracts\Mail\Mailer;

class SendWelcomeEmail implements ShouldQueue
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(Mailer $mailer)
    {
        $this->mailer = $mailer;
    }

    /**
     * Handle the event.
     *
     * @param  UserRegistered  $event
     * @return void
     */
    public function handle(UserRegistered $event)
    {
        // get the user from the event first
        $user = $event->user;
        $user->verify_token = str_random(30);
        $user->save();

        // send the email with the token
        Mail::send('emails.welcome', [
            'name' => $user->name,
            'token' => $user->verify_token
        ], function($message) use ($user) {
            $message->to($user->email);
            $message->subject('Verify your email');
        });

    }
}
