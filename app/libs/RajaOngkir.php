<?php
/**
 * Created by PhpStorm.
 * User: GMG-Developer
 * Date: 15/09/2017
 * Time: 9:59
 */

namespace App\libs;


use GuzzleHttp\Client;

class RajaOngkir
{
    public static function getCity($provinceId){
        $client = new Client([
            'base_uri' => 'https://pro.rajaongkir.com/api/city?province='. $provinceId,
            'headers' => [
                'key' => env('RAJAONGKIR_API_KEY')
            ],
        ]);

        $request = $client->request('GET', 'https://pro.rajaongkir.com/api/city?province='. $provinceId);

        if($request->getStatusCode() == 200){
            $collect = json_decode($request->getBody());

            return $collect;
        }
    }

    public static function getSubdistrict($cityId){
        $client = new Client([
            'base_uri' => 'https://pro.rajaongkir.com/api/subdistrict?city='. $cityId,
            'headers' => [
                'key' => env('RAJAONGKIR_API_KEY')
            ],
        ]);

        $request = $client->request('GET', 'https://pro.rajaongkir.com/api/subdistrict?city='. $cityId);

        if($request->getStatusCode() == 200){
            $collect = json_decode($request->getBody());

            return $collect;
        }
    }
}