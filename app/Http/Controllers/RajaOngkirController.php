<?php
/**
 * Created by PhpStorm.
 * User: GMG-Developer
 * Date: 19/10/2017
 * Time: 15:33
 */

namespace App\Http\Controllers;


use App\libs\RajaOngkir;

class RajaOngkirController extends Controller
{
    public function track($id){
        $collect = RajaOngkir::getWaybill($id);

        $returnHtml = View('admin.partials._show-tracks',['collect' => $collect])->render();

        return response()->json( array('success' => true, 'html' => $returnHtml) );
    }
}