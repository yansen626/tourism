<?php
/**
 * Created by PhpStorm.
 * User: yanse
 * Date: 18-Sep-17
 * Time: 11:43 AM
 */

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;


class EmailTransactionNotifUser extends Mailable
{
    use Queueable, SerializesModels;

    protected $transactionData;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($transactionData)
    {
        $this->transactionData = $transactionData->transactionDetail;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {

        $transactionDetail = $this->transactionData;
        return $this->view('email.transaction-notification-user', compact('transactionDetail'));
    }
}