<?php
/**
 * Created by PhpStorm.
 * User: yanse
 * Date: 18-Sep-17
 * Time: 11:43 AM
 */

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;


class NewOrderCustomer extends Mailable
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
                    ->subject('Payment Confirmed')
                    ->view('email.new-order-customer');
    }
}