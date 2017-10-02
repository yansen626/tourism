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

class DeliveryConfirm extends Mailable
{
    use Queueable, SerializesModels;
    protected $waybill;

    public function __construct($waybill)
    {
        $this->waybill = $waybill;
    }

    public function build()
    {
        return $this->from('admin@lowids.com')
            ->subject('Shipping Confirmed')
            ->view('email.delivery-confirm')
            ->with(['waybill' => $this->waybill]);
    }
}