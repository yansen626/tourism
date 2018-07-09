<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class CancelTransactionTraveller extends Mailable
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
            ->subject('Cancel Booking Confirmed!')
            ->view('email.cancel-transaction-traveller')->with([
            'route' => $this->route,
        ]);
    }
}
