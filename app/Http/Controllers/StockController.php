<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Stock;
use App\Models\Product;
use App\Models\Category;
use App\Models\Brand;

class StockController extends Controller
{
    //
    public function index(){

        $stocks = Stock::all();
        //dd($products);
        return view('stocks.index', compact('stocks'));
    }




    public function store(Request $request){
        //validate data
        $request->validate([
            'name'=>'required',
            'quantity'=>'required',
        ]);

        $product = new Stock;
        $product->name=$request->name;
        $product->quantity=$request->quantity;
        $product->category_id=$request->category_id;
        $product->save();
        return back()->withSuccess('stock created !!!!');
    }

    // public function destroy($id){

    //     $stock = Stock::where('id',$id)->first();

    //     $stock->delete();
    //     return back()->withSuccess('product Deleted !!!!');
    // }



}
