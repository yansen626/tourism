<?php
/**
 * Created by PhpStorm.
 * User: yanse
 * Date: 14-Sep-17
 * Time: 3:41 PM
 */

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Models\Transaction;


class ReportController extends Controller
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
        $transactions = Transaction::all()->sortByDesc('created_on');

        return View('admin.show-reports', compact('transactions'));
    }

    public function PrintPreview()
    {
        //
        $transactions = Transaction::all()->sortByDesc('created_on');

        return View('admin.show-report-print', compact('transactions'));
    }

}