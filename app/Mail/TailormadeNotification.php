<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class TailormadeNotification extends Mailable
{
    use Queueable, SerializesModels;

    protected $route;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($route)
    {
        //
        $this->route = $route;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
            ->from('hellbardx333@gmail.com')
            ->subject('Your Tailormade Confirmed!')
            ->view('email.tailormade-confirmed')->with([
            'route' => $this->route,
        ]);
    }
}
