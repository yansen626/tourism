<?php
/**
 * Created by PhpStorm.
 * User: GMG-Developer
 * Date: 30/08/2017
 * Time: 10:53
 */

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function dashboardShow($test){
        if(isset($test)){
            return view('admin.dashboard')->with('test', $test);
        }else{
            echo "failed";
        }
    }
}