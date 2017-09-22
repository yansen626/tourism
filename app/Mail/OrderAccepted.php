<?php
/**
 * Created by PhpStorm.
 * User: hellb
 * Date: 9/22/2017
 * Time: 12:34 PM
 */

namespace App\Mail;


use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OrderAccepted extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('admin@lowids.com')
            ->subject('Order Accepted')
            ->view('email.order-accepted-customer');
    }
}