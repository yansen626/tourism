<?php
/**
 * Created by PhpStorm.
 * User: GMG-Developer
 * Date: 04/10/2017
 * Time: 9:18
 */

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Models\Gallery;
use App\Models\GalleryImage;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Facades\Image;

class GalleryController extends Controller
{
    public function index(){
        $galleries = Gallery::all();
        $banners = Banner::all();

        $data = [
            'galleries' => $galleries,
            'banners'   => $banners
        ];

        return View('admin.show-galleries')->with($data);
    }

    public function create(Request $request){
        return View('admin.create-gallery');
    }

    public function store(Request $request){
        $validator = Validator::make($request->all(),[
            'name'                  => 'required|string|max:50'
        ]);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }

        $dateTimeNow = Carbon::now('Asia/Jakarta');
        $user = Auth::guard('user_admins')->user();

        $gallery = Gallery::create([
            'name'          => Input::get('name'),
            'status_id'     => 1,
            'created_at'    => $dateTimeNow->toDateTimeString(),
            'created_by'    => $user->id
        ]);

        return redirect()->route('gallery-image-list', ['galleryId' => $gallery->id]);
    }

    public function edit($id){
        $gallery = Gallery::find($id);

        if(empty($gallery)) return redirect()->route('gallery-list');

        return View('admin.edit-gallery', compact('gallery'));
    }

    public function update(Request $request, $id){
        $validator = Validator::make($request->all(),[
            'name'                  => 'required|string|        max:50'
        ]);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }

        $dateTimeNow = Carbon::now('Asia/Jakarta');
        $user = Auth::guard('user_admins')->user();

        $gallery = Gallery::find($id);
        $gallery->name = Input::get('name');
        $gallery->status_id = Input::get('status');
        $gallery->updated_by = $user->id;
        $gallery->updated_at = $dateTimeNow->toDateTimeString();
        $gallery->save();

        return redirect()->route('gallery-list');
    }

    public function delete($id){
        if(Banner::where('gallery_id', $id)->count() > 0){
            return redirect()->back()->withErrors('Please unassign gallery form banners first!');
        }

        $images = GalleryImage::where('gallery_id', $id)->get();

        if($images->count() > 0){
            foreach($images as $image){
                // Delete image file
                $deletedPath = storage_path('app/public/gallery/'. $image->file_name);
                if(file_exists($deletedPath)) unlink($deletedPath);

                // Delete record
                $image->delete();
            }
        }

        // Delete gallery record
        $gallery = Gallery::find($id);
        $gallery->delete();

        return redirect()->route('gallery-list');
    }

    public function imageIndex($galleryId){
        $gallery = Gallery::find($galleryId);
        $images = GalleryImage::where('gallery_id', $galleryId)->orderBy('position')->get();

        $data = [
            'gallery'   => $gallery,
            'images'    => $images
        ];

        return View('admin.show-gallery-images')->with($data);
    }

    public function imageCreate($galleryId){
        $gallery = Gallery::find($galleryId);
        $position = $gallery->gallery_images->count() + 1;

        $data = [
            'gallery'   => $gallery,
            'position'  => $position
        ];

        return View('admin.create-gallery-image')->with($data);
    }

    public function imageStore(Request $request, $galleryId){
        $validator = Validator::make($request->all(),[
            'image'                  => 'required|image|mimes:jpeg,jpg,png'
        ]);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }

        // Store uploaded image
        $img = Image::make($request->file('image'));

        // Get image extension
        $extStr = $img->mime();
        $ext = explode('/', $extStr, 2);

        $filename = $galleryId.'_'. Carbon::now('Asia/Jakarta')->format('Ymdhms'). '.'. $ext[1];

        $img->save(public_path('storage/gallery/'. $filename));

        GalleryImage::create([
            'gallery_id'    => $galleryId,
            'file_name'     => $filename,
            'position'      => Input::get('position')
        ]);

        if(Input::get('flag') == 'default'){
            return redirect()->route('gallery-image-list',['galleryId' => $galleryId]);
        }
        else{
            return redirect()->route('gallery-image-create',['galleryId' => $galleryId]);
        }

    }

    public function imageEdit($galleryId, $id){
        $gallery = Gallery::find($galleryId);
        $image = GalleryImage::find($id);

        $data = [
            'gallery'   => $gallery,
            'image'     => $image
        ];

        return View('admin.edit-gallery-image')->with($data);
    }

    public function imageUpdate(Request $request, $galleryId, $id){
        $validator = Validator::make($request->all(),[
            'image'                  => 'image|mimes:jpeg,jpg,png'
        ]);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }

        $images = GalleryImage::where('gallery_id', $galleryId)->get();
        $image = $images->where('id', $id)->first();

        // Store uploaded image
        if(!empty($request->file('image'))){
            $img = Image::make($request->file('image'));

            // Get image extension
            $extStr = $img->mime();
            $ext = explode('/', $extStr, 2);

            $filename = $galleryId.'_'. Carbon::now('Asia/Jakarta')->format('Ymdhms'). '.'. $ext[1];

            $img->save(public_path('storage/gallery/'. $filename));

            // Get old image
            $oldImage = $image->file_name;

            // Delete old image
            $deletedPath = storage_path('app/public/gallery/'. $oldImage);
            if(file_exists($deletedPath)) unlink($deletedPath);

            // Set new image
            $image->file_name = $filename;
        }

        $position = Input::get('position');
        if($image->position - 1 == $position || $image->position + 1 == $position){
            $image2 = $images->where('position', $position)->first();
            $image2->position = $image->position;
            $image2->save();
        }
        else {
            if($position > $image->position){
                $changedImages = $images->where('position','>',$image->position)
                    ->where('position','<=',$position);

                foreach ($changedImages as $changedImage){
                    $changedImage->position -= 1;
                    $changedImage->save();
                }
            }
            else if($position < $image->position){
                $changedImages = $images->where('position','<=',$image->position)
                    ->where('position','>',$position);

                foreach ($changedImages as $changedImage){
                    $changedImage->position += 1;
                    $changedImage->save();
                }
            }
        }

        $image->position = $position;
        $image->save();

        return redirect()->route('gallery-image-list',['galleryId' => $galleryId]);
    }

    public function imageDelete($galleryId, $id){
        $images = GalleryImage::where('gallery_id', $galleryId)->get();
        $deletedImage = $images->where('id', $id)->first();

        if($deletedImage->position != $images->count()){
            $changedImages = $images->where('position','>', $deletedImage->position);
            foreach($changedImages as $changedImage){
                $changedImage->position -= 1;
                $changedImage->save();
            }
        }

        // Get old image
        $deletedImageName = $deletedImage->file_name;

        // Delete image file
        $deletedPath = storage_path('app/public/gallery/'. $deletedImageName);
        if(file_exists($deletedPath)) unlink($deletedPath);

        // Delete image record
        $deletedImage->delete();

        return redirect()->route('gallery-image-list',['galleryId' => $galleryId]);
    }
}