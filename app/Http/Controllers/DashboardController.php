<?php

namespace App\Http\Controllers;

use App\TransactionHeader;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index() {
        $transaction = TransactionHeader::whereDate('created_at', Carbon::now())->get();
        $monthly_transaction = TransactionHeader::whereBetween('created_at', [Carbon::now()->startOfMonth(), Carbon::now()->endOfMonth()])->get();

        $income = 0;
        $daily_profit = 0;
        $weekly_profit = 0;
        $monthly_profit = 0;

//        foreach ($transaction as $t) {
//            foreach ($t->details as $d) {
//                $income += $d->quantity * $d->price;
//            }
//        }

        foreach ($monthly_transaction as $t) {
            foreach ($t->details as $d) {
                $monthly_profit += $d->quantity * ($d->price - $d->productDetail->buy_price);

                if (Carbon::now()->eq($t->created_at)){
                    $income += $d->quantity * $d->price;
                    $daily_profit += $d->quantity * ($d->price - $d->productDetail->buy_price);
                }

                if (Carbon::parse($t->created_at)->gte(Carbon::now()->startOfWeek())
                    && Carbon::parse($t->created_at)->lte(Carbon::now()->endOfWeek())) {
                    $weekly_profit += $d->quantity * ($d->price - $d->productDetail->buy_price);
                }

            }
        }

        $data = [
            "income"=>$income,
            "transaction"=>count($transaction),
            "daily_profit"=>$daily_profit,
            "weekly_profit"=>$weekly_profit,
            "monthly_profit"=>$monthly_profit,
        ];

        return view('dashboard.index')->with(['data'=>$data]);
    }
}
