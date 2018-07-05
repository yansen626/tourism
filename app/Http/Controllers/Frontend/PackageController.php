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
use App\Models\PackagePrice;
use App\Models\PackageTrip;

class PackageController extends Controller
{
    public function show($id){
        $package = Package::find($id);
        $packagePrices = PackagePrice::where('package_id', $id)->get();
        $packageTrips = PackageTrip::where('package_id', $id)->get();



        $data = [
            'package' => $package,
            'packagePrices' => $packagePrices,
            'packageTrips' => $packageTrips
        ];
        return View('frontend.packages.show')->with($data);
    }
}