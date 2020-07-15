<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function searchProduct(Request $request) {
        //        dd($request['query']);
        $query = explode(' ', $request['query']);
        $formated_query = '';

        foreach ($query as $q) {
            $formated_query .= "%$q%";
        }
        $data = Product::where('name', 'like', $formated_query)->take(5)->get();
        foreach ($data as $d) {
            $formated_name = json_decode($d->name);
            $d->name = "$formated_name->name $formated_name->code $formated_name->color $formated_name->type $formated_name->unit";
        }

        return $data;
    }
}
