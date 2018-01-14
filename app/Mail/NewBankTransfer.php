<?php
/**
 * Created by PhpStorm.
 * User: hellb
 * Date: 1/12/2018
 * Time: 2:52 PM
 */

namespace App\Mail;


use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NewBankTransfer extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct()
    {
        //
    }

    public function build()
    {
        return $this->from('admin@lowids.com')
            ->subject('Konfirmasi Transfer Bank')
            ->view('email.new-order-admin');
    }
}