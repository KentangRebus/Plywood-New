<?php

namespace App\Http\Controllers;

use App\TransactionHeader;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index() {
        $transaction = TransactionHeader::whereDate('created_at', Carbon::now())->get();
        \Data::whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->get();

        $income = 0;

        foreach ($transaction as $t) {
            foreach ($t->details as $d) {
                $income += $d->quantity * $d->price;
            }
        }

        $data = [
            "income"=>$income,
            "transaction"=>count($transaction),
            "daily_profit"=>0,
            "weekly_profit"=>0,
            "monthly_profit"=>0,
        ];

        return view('dashboard.index')->with(['data'=>$data]);
    }
}
