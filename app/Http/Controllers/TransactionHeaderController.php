<?php

namespace App\Http\Controllers;

use App\Product;
use App\TransactionDetail;
use App\TransactionHeader;
use PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransactionHeaderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::user()->role == "staff")
            return view('transaction.cashier.index');


        $data = TransactionHeader::orderBy('is_done', 'asc')->orderBy('created_at', 'asc')->orderBy('due_date', 'asc')->paginate(10);
        return view('transaction.index')->with(['data'=>$data]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
//        dd($request);
//      create transaction header
        $transaction_header = new TransactionHeader();
        $transaction_header->staff_id = Auth::user()->id;
        if ($request->paymentStatus == "Hutang") {
            $transaction_header->is_done = false;
            $transaction_header->needs = $request->need;
            $transaction_header->due_date = $request->dueDate;
        }
        else {
            $transaction_header->is_done = true;
        }
        $transaction_header->save();

//        create transaction detail and decrease product stock
        $product_list = json_decode($request->productList);
//        dd($product_list);
        foreach ($product_list as $product) {
            //add detail
            $detail = new TransactionDetail();
            $detail->id = $transaction_header->fresh()->id;
            $detail->product_id = $product->data->id;
            $detail->quantity = $product->quantity;
            $detail->price = $product->data->sell_price;
            $detail->save();

            //update stock
            $p = Product::where('id', '=', $product->data->id)->first();
            $p->stock -= $product->quantity;
            $p->save();
        }

        return redirect()->route('transaction-view')->with(['msg' => "Transaction has been recorded", 'print_id'=>$transaction_header->fresh()->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\TransactionHeader  $transactionHeader
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = TransactionHeader::where('id', '=', $id)->first();
//        dd($data);
        $total = 0;

        foreach ($data->details as $d) {
            $total += $d->quantity * $d->price;
        }

        return view('transaction.detail')->with(['data'=>$data, 'total'=>$total]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\TransactionHeader  $transactionHeader
     * @return \Illuminate\Http\Response
     */
    public function edit(TransactionHeader $transactionHeader)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\TransactionHeader  $transactionHeader
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TransactionHeader $transactionHeader)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\TransactionHeader  $transactionHeader
     * @return \Illuminate\Http\Response
     */
    public function destroy(TransactionHeader $transactionHeader)
    {
        //
    }

    public function print($id) {
        $data = TransactionHeader::where('id', '=', $id)->first();
        $total = 0;
        foreach ($data->details as $d) {
            $total += $d->quantity * $d->price;
        }
        $pdf = PDF::loadView('transaction.invoice', ['data'=>$data, 'total' => $total]);
        return $pdf->download("invoice[$id].pdf");
//        return view('transaction.invoice')->with(['data'=>$data, 'total' => $total]);
    }


}
