<?php
/**
 * Created by PhpStorm.
 * User: GMG-Developer
 * Date: 28/06/2018
 * Time: 10:41
 */

namespace App\Http\Controllers\Frontend;


use App\Http\Controllers\Controller;
use App\Models\General;
use App\Models\Package;
use App\Models\PackagePrice;
use App\Models\PackageTrip;
use Barryvdh\DomPDF\Facade as PDF;

class PackageController extends Controller
{
    public function show($id){
        $package = Package::find($id);
//        $packagePrices = PackagePrice::where('package_id', $id)->get();
//        $packageTrips = PackageTrip::where('package_id', $id)->get();
        $packagePrices = $package->package_prices;
        $packageTrips = $package->package_trips;

        $currencyType = "IDR";
        $currencyValue = 1;

        if(!empty(request()->currency)){
            $currencyType = request()->currency;
            $generalDB = General::find(1);

            if($currencyType == "USD"){
                $currencyValue = $generalDB->idrusd;
            }
            else if ($currencyType == "RMB"){
                $currencyValue = $generalDB->idrrmb;
            }
        };


        $data = [
            'package' => $package,
            'packagePrices' => $packagePrices,
            'packageTrips' => $packageTrips,
            'currencyType' => $currencyType,
            'currencyValue' => $currencyValue
        ];
//        dd($data);
        return View('frontend.transactions.show')->with($data);
    }

    public function ConvertToPDF($id){
        $package = Package::find($id);
//        $packagePrices = PackagePrice::where('package_id', $id)->get();
//        $packageTrips = PackageTrip::where('package_id', $id)->get();
        $packagePrices = $package->package_prices;
        $packageTrips = $package->package_trips;

        $currencyType = "IDR";
        $currencyValue = 1;

        if(!empty(request()->currency)){
            $currencyType = request()->currency;
            $generalDB = General::find(1);

            if($currencyType == "USD"){
                $currencyValue = $generalDB->idrusd;
            }
            else if ($currencyType == "RMB"){
                $currencyValue = $generalDB->idrrmb;
            }
        };


        $data = [
            'package' => $package,
            'packagePrices' => $packagePrices,
            'packageTrips' => $packageTrips,
            'currencyType' => $currencyType,
            'currencyValue' => $currencyValue
        ];
//        dd($data);
        $pdf = PDF::loadView('pdf.package-pdf', $data);
        return $pdf->download('Package Information.pdf');
//        return View('pdf.package-pdf')->with($data);
    }
}