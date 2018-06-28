<?php
/**
 * Created by PhpStorm.
 * User: GMG-Developer
 * Date: 28/08/2017
 * Time: 14:11
 */

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TransactionHeader;
use App\Models\Travelmate;
use App\Models\User;
use Auth;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;

class TravelmateController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:user_admins');
    }

    public function index()
    {
        $users = Travelmate::all();

        return View('admin.travelmates.index', compact('users'));
        //return view('admin.show_users')->with('users', $users);
    }

    public function transactions($customerId){
        $transactions = TransactionHeader::where('user_id', $customerId)->orderByDesc('created_at')->get();

        $data = [
            'transactions'  => $transactions,
            'customerId'    => $customerId
        ];

        return View('admin.travelmates.index-transactions')->with($data);
    }
}