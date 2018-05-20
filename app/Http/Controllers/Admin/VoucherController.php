<?php
/**
 * Created by PhpStorm.
 * User: GMG-Developer
 * Date: 08/09/2017
 * Time: 14:19
 */

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Voucher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;

class VoucherController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:user_admins');
    }

    public function index(){
        $vouchers = Voucher::all();

        return View('admin.vouchers.show', compact('vouchers'));
    }

    public function create(){
        return View('admin.vouchers.create');
    }

    public function store(Request $request){
        $validator = Validator::make($request->all(),[
            'name'      => 'required',
            'stock'      => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput($request->all());
        }
        if($request->input('amount') == null && $request->input('amount_percentage') == null)
            return redirect()->back()->withErrors('Salah satu potongan harus diisi!', 'default')->withInput($request->all());

        $voucher = Voucher::create([
            'name'      => $request->input('name'),
            'amount'      => $request->input('amount'),
            'amount_percentage'      => $request->input('amount_percentage'),
            'stock'      => $request->input('stock'),
        ]);

        Session::flash('message', 'Berhasil membuat voucher!');

        return redirect('/admin/voucher');
    }

    public function edit($id){
        $voucher = Voucher::find($id);

        return View('admin.vouchers.edit', compact('voucher'));
    }

    public function update(Request $request, $id){
        $validator = Validator::make($request->all(),[
            'name'      => 'required',
            'stock'      => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput($request->all());
        }
        if($request->input('amount') == null && $request->input('amount_percentage') == null)
            return redirect()->back()->withErrors('Salah satu potongan harus diisi!', 'default')->withInput($request->all());


        $voucher = Voucher::find($id);
        $voucher->name = $request->input('name');
        $voucher->amount = $request->input('amount');
        $voucher->amount_percentage = $request->input('amount_percentage');
        $voucher->stock = $request->input('stock');
        $voucher->save();

        Session::flash('message', 'Berhasil mengubah voucher!');

        return redirect('/admin/voucher');
    }
}