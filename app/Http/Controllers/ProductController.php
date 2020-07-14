<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Product::orderBy('stock', 'asc')->get();

        foreach ($data as $d) {
            $formated_name = json_decode($d->name);
            $d->name = "$formated_name->name $formated_name->code $formated_name->color $formated_name->type $formated_name->unit";
        }

        return view('product.index')->with(['data'=>$data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('product.insert');
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
        $name = [
            'code' => $request->code,
            'name' => $request->name,
            'type' => $request->type,
            'unit' => $request->unit,
            'color' => $request->color,
        ];
//        dd($name);

        $product = new Product();
        $product->name = json_encode($name);
        $product->buy_price = $request->buyPrice;
        $product->sell_price = $request->sellPrice;
        $product->stock = $request->stock;
        $product->min_stock = $request->minStock;
        $product->save();

        return redirect()->route('product-view')->with(['msg' => "New product has been added"]);
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $products
     * @return \Illuminate\Http\Response
     */
    public function show(Product $products)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $products
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Product::where('id', '=', $id)->first();
        $data->name = json_decode($data->name);
        return view('product.update')->with(['data'=>$data]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $products
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $product = Product::where('id', '=', $id)->first();

        $name = [
            'code' => $request->code,
            'name' => $request->name,
            'type' => $request->type,
            'unit' => $request->unit,
            'color' => $request->color,
        ];
        $product->name = json_encode($name);
        $product->buy_price = $request->buyPrice;
        $product->sell_price = $request->sellPrice;
        $product->stock = $request->stock;
        $product->min_stock = $request->minStock;
        $product->save();

        return redirect()->route('product-view')->with(['msg' => "Product has been updated"]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $products
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $products)
    {
        //
    }
}
