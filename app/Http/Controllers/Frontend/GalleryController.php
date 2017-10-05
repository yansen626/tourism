<?php
/**
 * Created by PhpStorm.
 * User: GMG-Developer
 * Date: 05/10/2017
 * Time: 9:28
 */

namespace App\Http\Controllers\Frontend;


use App\Http\Controllers\Controller;
use App\Models\Gallery;
use App\Models\GalleryImage;

class GalleryController extends Controller
{
    public function index($id){
        $images = GalleryImage::where('gallery_id', $id)->orderBy('position')->get();
        $gallery = Gallery::find($id);

        $data = [
            'images'    => $images,
            'gallery'   => $gallery
        ];

        return View('frontend.show-gallery')->with($data);
    }
}