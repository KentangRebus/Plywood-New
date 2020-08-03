<?php

namespace App\Http\Controllers;

use App\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Customer::orderBy('debt', 'desc')->paginate(10);

        return view('customer.index')->with(['data'=>$data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('customer.insert');
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
        $customer = new Customer();
        $customer->name = $request->name;
        $customer->address = $request->address;
        $customer->phone = $request->phone;
        $customer->nik = $request->nik;
        $customer->npwp = $request->npwp;
        $customer->save();

        return redirect()->route('customer-view')->with(['msg'=>'Customer berhasil ditambahkan']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = Customer::where('id', '=' ,$id)->first();
        return view('customer.detail')->with(['data'=>$data]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Customer::where('id', '=' ,$id)->first();

        return view('customer.update')->with(['data'=>$data]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $customer = Customer::where('id', '=' ,$id)->first();
        $customer->name = $request->name;
        $customer->address = $request->address;
        $customer->phone = $request->phone;
        $customer->nik = $request->nik;
        $customer->npwp = $request->npwp;
        $customer->save();

        return redirect()->route('customer-view')->with(['msg'=>'Customer berhasil diperbaharui']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $customer = Customer::where('id', '=', $id)->first();
        if (count($customer->transactions) == 0){
            $customer->delete();
            return redirect()->route('customer-view')->with(['msg'=>'Customer berhasil didelete']);
        }

        return redirect()->route('customer-view')->with(['error'=>'Customer tidak bisa didelete karena memiliki transaksi']);
    }
}
