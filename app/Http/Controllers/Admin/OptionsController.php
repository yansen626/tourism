<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\StoreDatum;
use Illuminate\Support\Facades\Session;

class OptionsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:user_admins');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $storeData = StoreDatum::all();
        $data = $storeData->first();

        return View('admin.options', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //
        $this->validate(request(), [
            'address' => 'required',
            'province_id' => 'required',
            'city_id' => 'required'
        ]);

        $storedata = StoreDatum::all();
        $data = $storedata->first();

        $data->address = $request['address'];
        $data->province_id = $request['province_id'];
        $data->city_id = $request['city_id'];

        Session::flash('message', 'Success Updating Store Data!!!');

        return redirect('admin/options');
    }
}
