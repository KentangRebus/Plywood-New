<?php

namespace App\Http\Controllers;

use App\Product;
use App\Report;
use App\TransactionHeader;
use Carbon\Carbon;
use PDF;
use Illuminate\Http\Request;

class ReportController extends Controller
{

    public function index() {
        return view('report.index');
    }

//    monthly report
    public function monthlyStockReport() {
        $header_data = TransactionHeader::whereBetween('created_at', [Carbon::now()->startOfMonth(), Carbon::now()->endOfMonth()])->get();
        $detailData = array();
        foreach ($header_data as $header) {
            foreach ($header->details as $d) {
                array_push($detailData, $d);
            }
        }
        usort($detailData, function ($a, $b){
            return strcmp($a->product_id, $b->product_id );
        });

        $formated_data = array();
        $counter = 0;
        foreach ($detailData as $d) {

            if (count($formated_data) == 0) {
                $product = Product::where('id', '=', $d->product_id)->first();
                array_push($formated_data, array(
                    'productId' => $d->product_id,
                    'productName' => $product->name,
                    'sellPrice' => $product->sell_price,
                    'buyPrice' => $product->buy_price,
                    'sold' => $d->quantity,
                    'stock' => $product->stock
                ));
            }
            else {
                if ($formated_data[$counter]['productId'] == $d->product_id){
                    $formated_data[$counter]["sold"] += $d->quantity;
                }
                else {
                    $counter++;
                    $product = Product::where('id', '=', $d->product_id)->first();
                    array_push($formated_data, array(
                        'productId' => $d->product_id,
                        'productName' => $product->name,
                        'sellPrice' => $product->sell_price,
                        'buyPrice' => $product->buy_price,
                        'sold' => $d->quantity,
                        'stock' => $product->stock
                    ));
                }
            }

        }

        $pdf = PDF::loadView('report.stock', ['data'=>$formated_data]);
        return $pdf->download("LaporanStockBulanan.pdf");
//        return $pdf;
    }
}
