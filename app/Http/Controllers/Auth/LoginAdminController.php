<?php
/**
 * Created by PhpStorm.
 * User: GMG-Developer
 * Date: 29/08/2017
 * Time: 9:24
 */

namespace App\Http\Controllers\Auth;


use App\Http\Controllers\Controller;
use App\Models\UserAdmin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class LoginAdminController extends Controller
{
    public function login(Request $request){
        $validator = Validator::make($request->all(),
            [
                'email'           => 'required|email|max:100|unique:users',
                'password'        => 'required|min:6|max:20'
            ]
        );

        if($validator->fails()){
            $this->throwValidationException(
                $request, $validator
            );
        }

        $email = $request->input('email');
        $pass = $request->input('password');

        //error_log($passEncrypted);

        $userAdmin = UserAdmin::where('email', '=', $email)->first();

        $msg = "Not Found!";
        if(!isset($userAdmin)){
            //return redirect()->route('login-admin', compact('msg'));
            return view('admin.login')->with('msg', $msg);
        }

        if (!Hash::check($pass, $userAdmin->password)) {
            //return redirect()->route('login-admin', compact('msg'));
            return view('admin.login')->with('msg', $msg);
        }else{
            return redirect()->route('admin-dashboard');
        }

//        if(!$userAdmin->count()){
//            return redirect()->route('login-admin', compact('msg'));
//        }else{
//            return redirect()->route('admin-dashboard');
//        }
    }
}