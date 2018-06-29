<?php
/**
 * Created by PhpStorm.
 * User: GMG-Developer
 * Date: 02/10/2017
 * Time: 15:33
 */

namespace App\Mail;


use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class TravelmateConfirmed extends Mailable
{
    use Queueable, SerializesModels;

    public function build()
    {
        return $this->from('hellbardx333@gmail.com')
            ->subject('Registration Complete')
            ->view('email.travelmate-confirm');
    }
}