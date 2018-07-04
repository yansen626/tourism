<?php
/**
 * Created by PhpStorm.
 * User: GMG-Developer
 * Date: 28/06/2018
 * Time: 10:41
 */

namespace App\Http\Controllers\Frontend;


use App\Http\Controllers\Controller;
use App\Models\Package;

class PackageController extends Controller
{
    public function show($id){
        $package = Package::find($id);
        $data = [
            'package' => $package
        ];
        return View('frontend.packages.show')->with($data);
    }
}