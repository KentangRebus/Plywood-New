<?php

namespace App\Http\Controllers;

use App\Category;
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
        $data = Product::orderBy('stock', 'asc')->paginate(10);
        foreach ($data as $d) {
            $formated_name = json_decode($d->name);
            $d->name = "$formated_name->code $formated_name->name $formated_name->type $formated_name->brand $formated_name->unit $formated_name->description";
        }

        $category = Category::all();

        return view('product.index')->with(['data'=>$data, 'categories' => $category]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view('product.insert')->with(['categories'=>$categories]);
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
            'brand' => $request->brand,
            'unit' => $request->unit,
            'description' => $request->description,
        ];
//        dd($name);

        $product = new Product();
        $product->name = json_encode($name);
        $product->buy_price = $request->buyPrice;
        $product->sell_price = $request->sellPrice;
        $product->stock = $request->stock;
        $product->min_stock = $request->minStock;
        $product->category_id = $request->category;
        $product->save();

        return redirect()->route('product-view')->with(['msg' => "New product has been added"]);
    }


    public function show(Request $request)
    {
        $query = explode(' ', $request['query']);
        $formated_query = '';
        $searchCategory = $request->searchCategory ?? '';
//        dd($searchCategory);

        foreach ($query as $q) {
            $formated_query .= "%$q%";
        }
        $data = Product::where('name', 'like', $formated_query)->where('category_id', 'like', "%$searchCategory%")->orderBy('stock', 'asc')->paginate(10);
        foreach ($data as $d) {
            $formated_name = json_decode($d->name);
            $d->name = "$formated_name->code $formated_name->name $formated_name->type $formated_name->brand $formated_name->unit $formated_name->description";
        }

        $categories = Category::all();

        return view('product.index')->with(['data'=>$data, 'query' => $request['query'], 'categories'=>$categories]);
//        return redirect()->route('product-view')->with(['data'=>$data, 'query' => $request['query']]);
    }

    public function filterQuery($value, $key, $query){
        return !strpos($value, $query);
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
            'brand' => $request->brand,
            'unit' => $request->unit,
            'description' => $request->description,
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
    public function destroy(Request $request)
    {
        $product = Product::where('id', '=', $request->id)->first();
        $product->delete();

        return redirect()->route('product-view')->with(['msg' => "Product has been deleted"]);
    }
}
