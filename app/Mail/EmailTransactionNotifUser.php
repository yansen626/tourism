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


class EmailTransactionNotifUser extends Mailable
{
    use Queueable, SerializesModels;
    protected $transaction;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(\App\Models\Transaction $transaction)
    {
        $this->transaction = $transaction;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('email.transaction-notification-user')
                    ->with(['transaction'   => $this->transaction]);
    }
}