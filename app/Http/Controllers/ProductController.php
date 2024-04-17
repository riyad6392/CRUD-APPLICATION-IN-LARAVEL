<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    public function index(){

        $products = Product::all(); 
        return view('products.index', compact('products'));
    }

    public function create(){
        return view('products.create');
    }
    public function store(Request $request){
        //validate data
        $request->validate([
            'name'=>'required',
            'description'=>'required',
            'image'=>'required|mimes:jpeg,jpg,png,gif|max:1000'
        ]);




        //upload image
        $imageName=time().'.'.$request->image->extension();

        //$request->image->move(public_path('products'),$imageName);
        $request->image->storeAs('uploads',$imageName);


        $product = new product;
        $product->image=$imageName;
        $product->name=$request->name;
        $product->description=$request->description;
        $product->save();
        return back()->withSuccess('product created !!!!');
    }

    public function edit($id){
        $product = Product::where('id',$id)->first();
        return view('products.edit',['product'=>$product]);
    }

    public function update(Request $request,$id){
        //validate data
        $request->validate([
            'name'=>'required',
            'description'=>'required',
            'image'=>'nullable|mimes:jpeg,jpg,png,gif|max:1000'
        ]);

        $product = Product::where('id',$id)->first();

        if(isset($request->image)){
             //upload image
             $imageName=time().'.'.$request->image->extension();

             //$request->image->move(public_path('products'),$imageName);
             $request->image->storeAs('uploads',$imageName);


             $product->image=$imageName;
        }

       
        $product->name=$request->name;
        $product->description=$request->description;
        $product->save();
        return back()->withSuccess('product Updated !!!!');
        }

    public function destroy($id){

        $product = Product::where('id',$id)->first();

         $imagePath = storage_path('app/public/uploads/' . $product->image);
         if (file_exists($imagePath)) {
          unlink($imagePath);
         }


        $product->delete();
        return back()->withSuccess('product Deleted !!!!');
    }

       
}
