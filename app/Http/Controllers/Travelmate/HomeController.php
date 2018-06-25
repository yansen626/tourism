<?php
/**
 * Created by PhpStorm.
 * User: yanse
 * Date: 8/31/2017
 * Time: 11:27 AM
 */

namespace App\Http\Controllers\Travelmate;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Redirect;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:travelmates');
    }

    //
    public function index(){
        return view('travelmate.dashboard');
    }

    public function dashboard(){
        return view('travelmate.dashboard');
    }
}
