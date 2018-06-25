<?php
/**
 * Created by PhpStorm.
 * User: GMG-Developer
 * Date: 25/06/2018
 * Time: 14:45
 */

namespace App\Http\Controllers\Frontend;


use App\Http\Controllers\Controller;

class ProfileController extends Controller
{
    public function edit(){
        return View('frontend.traveler.profile-edit');
    }
}