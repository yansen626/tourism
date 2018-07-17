<?php
/**
 * Created by PhpStorm.
 * User: GMG-Developer
 * Date: 30/08/2017
 * Time: 15:31
 */

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Models\HomeContent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Facades\Image;

class ContentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:user_admins');
    }

    public function edit()
    {
        //
        $data = [
            'home'=> HomeContent::where('section', 'banner')->get(),
            'video'=> HomeContent::where('section', 'video')->first()
        ];
        return View('admin.home_contents.edit')->with($data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try{
            //banner
            if($id == "banner"){
                $validator = Validator::make($request->all(),[
                    'content_1'         => 'required',
                    'content_2'         => 'required',
                    'content_3'         => 'required'
                ]);

                $images = $request->file('background_image');
                $content1 = $request->input('content_1');
                $content2 = $request->input('content_2');
                $content3 = $request->input('content_3');

                $isNullcontent1 = in_array(null, $content1);
                $isNullcontent2 = in_array(null, $content2);
                $isNullcontent3 = in_array(null, $content3);

                if($isNullcontent1 && $isNullcontent2 && $isNullcontent3){
                    return back()->withErrors("konten harus diisi")->withInput();
                }

                if ($validator->fails()) {
                    return back()->withErrors($validator)->withInput();
                }

                $contentDB = HomeContent::where('section', 'banner')->orderBy('id')->get();
                $ct = 0;

                foreach ($contentDB as $content){
                    $content->content_1 = $content1[$ct];
                    $content->content_2 = $content2[$ct];
                    $content->content_3 = $content3[$ct];
                    $content->save();

                    if(!empty($images[$ct])){
                        $img = Image::make($images[$ct]);
                        $img->save(public_path('frontend_images/'.$content->image_path));
                    }
                    $ct++;
                }
            }
            //video
            else if($id == "video"){
                $validator = Validator::make($request->all(),[
                    'link'         => 'required'
                ]);

                if ($validator->fails()) {
                    return back()->withErrors($validator)->withInput();
                }

//                dd($request);
                $contentDB = HomeContent::where('section', $id)->first();
                $contentDB->link = $request->input('link');
                $contentDB->save();
            }

            Session::flash('message', 'Update Success!');
//        return redirect('admin/content/edit');
            return redirect()->route('content-edit');
        }
        catch (\Exception $ex){
            Session::flash('message', 'Update Failed!');
//        return redirect('admin/content/edit');
            return redirect::route('content-edit');
        }

    }

}