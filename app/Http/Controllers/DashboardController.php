<?php

namespace App\Http\Controllers;

use App\TransactionHeader;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index() {
        $monthly_transaction = TransactionHeader::whereBetween('created_at', [Carbon::now()->startOfMonth(), Carbon::now()->endOfMonth()])->get();
        $income = 0;
        $daily_profit = 0;
        $weekly_profit = 0;
        $monthly_profit = 0;
        $transaction_count = 0;

//        foreach ($transaction as $t) {
//            foreach ($t->details as $d) {
//                $income += $d->quantity * $d->price;
//            }
//        }

        foreach ($monthly_transaction as $t) {
            if (Carbon::now()->isSameDay($t->created_at))
                $transaction_count += 1;
            foreach ($t->details as $d) {
                $monthly_profit += $d->quantity * ($d->price - $d->productDetail->buy_price);
                if (Carbon::now()->isSameDay($t->created_at)){
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
            "transaction"=>$transaction_count,
            "daily_profit"=>$daily_profit,
            "weekly_profit"=>$weekly_profit,
            "monthly_profit"=>$monthly_profit,
        ];

        return view('dashboard.index')->with(['data'=>$data]);
    }
}
