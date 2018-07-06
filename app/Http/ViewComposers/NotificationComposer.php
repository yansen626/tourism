<?php
/**
 * Created by PhpStorm.
 * User: GMG-Developer
 * Date: 03/04/2018
 * Time: 10:41
 */

namespace App\Http\ViewComposers;


use App\Models\Cart;
use Illuminate\View\View;

class NotificationComposer
{
    public $notifications;
    public $data;

    public function __construct()
    {
        if(auth()->guard('web')->check()){
            $this->notifications = Cart::where('user_id', auth()->user()->id);
        }

        $this->data = [
            'notifications' => $this->notifications
        ];
    }

    public function compose(View $view)
    {
        $view->with($this->data);
    }
}