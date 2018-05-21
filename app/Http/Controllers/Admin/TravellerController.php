<?php
/**
 * Created by PhpStorm.
 * User: GMG-Developer
 * Date: 28/08/2017
 * Time: 14:11
 */

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Auth;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;

class TravellerController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:user_admins');
    }

    public function index()
    {
        $users = User::all();

        return View('admin.travellers.index', compact('users'));
        //return view('admin.show_users')->with('users', $users);
    }

    public function transactions($customerId){
        $transactions = Transaction::where('user_id', $customerId)->orderByDesc('created_on')->get();

        $data = [
            'transactions'  => $transactions,
            'customerId'    => $customerId
        ];

        return View('admin.travellers.index-transactions')->with($data);
    }
}