<?php
/**
 * Created by PhpStorm.
 * User: yanse
 * Date: 14-Sep-17
 * Time: 2:38 PM
 */

namespace App\libs;

use App\Models\Transaction;
use Carbon\Carbon;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;


class Utilities
{
    //generate invoice number
    public static function GenerateInvoice() {
        $start = Carbon::yesterday('Asia/Jakarta');
        $end = Carbon::tomorrow('Asia/Jakarta');
        $date = date_format($start, 'dmy');

        $transactionCount = Transaction::whereBetween('created_on', [$start->toDateString(),$end->toDateString()])->count();
        $number = str_pad($transactionCount+1, 3, '0', STR_PAD_LEFT);

        return "IN".$date.$number;
    }

    public static function ExceptionLog($ex){
        $logContent = ['id' => 1,
            'description' => $ex];

        $log = new Logger('exception');
        $log->pushHandler(new StreamHandler(storage_path('logs/error.log')), Logger::ALERT);
        $log->info('exception', $logContent);
    }
}