<?php
/**
 * Created by PhpStorm.
 * User: GMG-Developer
 * Date: 12/09/2017
 * Time: 13:37
 */

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Models\Gallery;
use App\Models\GalleryImage;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Redirect;

class BannerController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:user_admins');
    }

    public function index($type){

        if($type == 'top_first_banner'){
            $banners = Banner::where('type', 1)->get();
        }
        elseif($type == 'top_second_banner'){
            $banners = Banner::where('type', 2)->get();
        }

        $data = [
            'banners'   => $banners,
            'type'      => $type
        ];

        return View('admin.show-slider-banners')->with($data);
    }

    public function create($type){
        $products = Product::where('status_id', 1)->get();
        $galleries = Gallery::all();

        $data = [
            'products'  => $products,
            'galleries' => $galleries,
            'type'      => $type
        ];

        return View('admin.create-slider-banner')->with($data);
    }

    public function store(Request $request, $type){
        $validator = Validator::make($request->all(),[
            'image'         => 'required|image|mimes:jpeg,jpg,png',
            'caption'       => 'max:100',
            'subcaption'    => 'max:100',
            'url'           => 'max:50'
        ]);

        if ($validator->fails()) {
            $this->throwValidationException(
                $request, $validator
            );
        }

        if(Input::get('options') == 'link-product'){
            if(Input::get('product') == '-1'){
                return redirect()->route('slider-banner-create')->withErrors('Please select a product');
            }
        }
        else if(Input::get('options') == 'link-gallery'){
            if(Input::get('gallery') == '-1'){
                return redirect()->route('slider-banner-create')->withErrors('Please select a gallery');
            }
            else{
                if(GalleryImage::where('gallery_id', Input::get('gallery'))->count() == 0){
                    return redirect()->back()->withErrors('Selected gallery is empty');
                }
            }
        }

        $banner = new Banner;

        // Get banner type
        if($type == 'top_first_banner'){
            $banner->type = 1;
        }
        elseif($type == 'top_second_banner'){
            $banner->type = 2;
        }

        $banner->status_id = 1;
        $banner->created_at = Carbon::now('Asia/Jakarta');
        $banner->created_by = Auth::guard('user_admins')->id();

        if(!empty(Input::get('caption'))) $banner->caption = Input::get('caption');
        if(!empty(Input::get('subcaption'))) $banner->sub_caption = Input::get('subcaption');

        if(!empty($request->file('image'))){
            $img = Image::make($request->file('image'));

            // Get image extension
            $extStr = $img->mime();
            $ext = explode('/', $extStr, 2);

            $filename = 'banner0_'. Carbon::now('Asia/Jakarta')->format('Ymdhms'). '.'. $ext[1];

            $img->save(public_path('storage/banner/'. $filename));

            $banner->image_path = $filename;
        }

        if(Input::get('options') == 'link-product'){
            $banner->product_id = Input::get('product');
        }
        else if(Input::get('options') == 'link-gallery'){
            $banner->gallery_id = Input::get('gallery');
        }
        else{
            if(!empty(Input::get('url'))) {
                $formattedUrl = preg_replace('#^https?://#', '', Input::get('url'));
                $banner->url = $formattedUrl;
            }
        }

        $banner->save();

        return redirect::route('slider-banner-list', ['type' => $type]);
    }

    public function edit($id){
        $banner = Banner::find($id);
        $products = Product::where('status_id', 1)->get();
        $galleries = Gallery::where('status_id', 1)->get();

        if($banner->type == 1){
            $type = 'top_first_banner';
        }
        else{
            $type = 'top_second_banner';
        }

        $data = [
            'banner'        => $banner,
            'products'      => $products,
            'galleries'     => $galleries,
            'type'          => $type
        ];

        return View('admin.edit-slider-banner')->with($data);
    }

    public function update(Request $request, $id){
        $validator = Validator::make($request->all(),[
            'image'         => 'mimes:jpeg,jpg,png',
            'caption'       => 'max:100',
            'subcaption'    => 'max:100',
            'url'           => 'max:50'
        ]);

        if ($validator->fails()) {
            $this->throwValidationException(
                $request, $validator
            );
        }

        if(Input::get('options') == 'link-product'){
            if(Input::get('product') == '-1'){
                return redirect()->back()->withErrors('Please select a product');
            }
        }
        else if(Input::get('options') == 'link-gallery'){
            if(Input::get('gallery') == '-1'){
                return redirect()->back()->withErrors('Please select a gallery');
            }
            else{
                if(GalleryImage::where('gallery_id', Input::get('gallery'))->count() == 0){
                    return redirect()->back()->withErrors('Selected gallery is empty');
                }
            }
        }

        $banner = Banner::find($id);

        $type = 'top_first_banner';
        if($banner->type == 2){
            $type = 'top_second_banner';
        }

        if(Input::get('status') == '0'){
            $banner->status_id = 2;
        }else{
            $banner->status_id = 1;
        }

        $banner->updated_at = Carbon::now('Asia/Jakarta');
        $banner->updated_by = Auth::guard('user_admins')->id();

        if(!empty(Input::get('caption'))){
            $banner->caption = Input::get('caption');
        }
        else{
            $banner->caption = null;
        }

        if(!empty(Input::get('subcaption'))){
            $banner->sub_caption = Input::get('subcaption');
        }else{
            $banner->sub_caption = null;
        }

        if(!empty($request->file('image'))){
            $img = Image::make($request->file('image'));

            // Get image extension
            $extStr = $img->mime();
            $ext = explode('/', $extStr, 2);

            $filename = 'banner'. $id. '_'. Carbon::now('Asia/Jakarta')->format('Ymdhms'). '_0.'. $ext[1];

            $img->save(public_path('storage/banner/'. $filename));

            // Save old banner image
            $oldImgPath = $banner->image_path;

            // Set new banner image
            $banner->image_path = $filename;

            // Delete old banner image
            $deletedPath = storage_path('app/public/banner/'. $oldImgPath);
            if(file_exists($deletedPath)) unlink($deletedPath);
        }

        if(Input::get('options') == 'link-product'){
            $banner->product_id = Input::get('product');
            $banner->url = null;
            $banner->gallery_id = null;
        }
        else if(Input::get('options') == 'link-gallery'){
            $banner->gallery_id = Input::get('gallery');
            $banner->product_id = null;
            $banner->url = null;
        }
        else{
            if(!empty(Input::get('url'))) {
                $formattedUrl = preg_replace('#^https?://#', '', Input::get('url'));
                $banner->url = $formattedUrl;
                $banner->product_id = null;
                $banner->gallery_id = null;
            }
        }

        $banner->save();
        error_log($type);

        return redirect::route('slider-banner-list', ['type' => $type]);
    }

    public function delete($id){
        $banner = Banner::find($id);

        // Delete banner image
        $deletedPath = storage_path('app/public/banner/'. $banner->image_path);
        if(file_exists($deletedPath)) unlink($deletedPath);

        $banner->delete();

        return redirect::route('slider-banner-list');
    }

    public function topBannerIndex(){
        $banner1st = Banner::where('type',2)->get()->first();
        $banner2nd = Banner::where('type',3)->get()->first();
        $banner3rd = Banner::where('type',4)->get()->first();
        $banner4th = Banner::where('type',5)->get()->first();

        $data = [
            'banner1st'     => $banner1st,
            'banner2nd'     => $banner2nd,
            'banner3rd'     => $banner3rd,
            'banner4th'     => $banner4th
        ];

        return View('admin.show-top-banners')->with($data);
    }

    public function topBannerEdit($id){
        $banner = Banner::find($id);
        $galleries = $galleries = Gallery::where('status_id', 1)->get();

        $data = [
            'banner'    => $banner,
            'galleries' => $galleries
        ];

        return View('admin.edit-top-banner')->with($data);
    }

    public function topBannerUpdate(Request $request, $id){
        $validator = Validator::make($request->all(),[
            'image'         => 'mimes:jpeg,jpg,png',
            'url'           => 'max:50'
        ]);

        if ($validator->fails()) {
            $this->throwValidationException(
                $request, $validator
            );
        }

        else if(Input::get('options') == 'link-gallery'){
            if(Input::get('gallery') == '-1'){
                return redirect()->back()->withErrors('Please select a gallery');
            }
            else{
                if(GalleryImage::where('gallery_id', Input::get('gallery'))->count() == 0){
                    return redirect()->back()->withErrors('Selected gallery is empty');
                }
            }
        }

        $banner = Banner::find($id);

        $banner->updated_at = Carbon::now('Asia/Jakarta');
        $banner->updated_by = Auth::guard('user_admins')->id();

        if(Input::get('options') == 'link-gallery'){
            $banner->gallery_id = Input::get('gallery');
            $banner->url = null;
        }
        else{
            $formattedUrl = preg_replace('#^https?://#', '', Input::get('url'));
            $banner->url = $formattedUrl;
            $banner->gallery_id = null;
        }

        if(!empty($request->file('image'))){
            $img = Image::make($request->file('image'));

            // Get image extension
            $extStr = $img->mime();
            $ext = explode('/', $extStr, 2);

            $filename = 'banner'. $id. '_'. Carbon::now('Asia/Jakarta')->format('Ymdhms'). '.'. $ext[1];

            $img->save(public_path('storage/banner/'. $filename));

            // Save old banner image
            if(!empty($banner->image_path)){
                $oldImgPath = $banner->image_path;

                // Delete old banner image
                $deletedPath = storage_path('app/public/banner/'. $oldImgPath);
                if(file_exists($deletedPath)) unlink($deletedPath);
            }

            // Set new banner image
            $banner->image_path = $filename;
        }

        $banner->save();

        return redirect::route('top-banner-list');
    }
}