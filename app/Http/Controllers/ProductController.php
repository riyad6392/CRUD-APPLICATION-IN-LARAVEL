<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\Brand;
use App\Models\Stock;


class ProductController extends Controller
{
    public function index(){

        $products = Product::with(['category:id,name', 'brand:id,name'])->get();
        //dd($products);
        return view('products.index', compact('products'));
    }

    public function create(){

             $categories = Category::all();
             $brand = Brand::all();
             //$stock= Stock::all();
             $product=Product::all();
             return view('products.create', ["categories" => $categories, "brands" => $brand, "products" => $product]);


    }
    public function store(Request $request){
        //validate data
        //dd($request->all());
        $request->validate([
            'name'=>'required',
            'description'=>'required',
            'category_id'=>'required|exists:categories,id',
            'image'=>'required|mimes:jpeg,jpg,png,gif|max:1000'
        ]);




        //upload image
        $imageName=time().'.'.$request->image->extension();

        //$request->image->move(public_path('products'),$imageName);
        $request->image->storeAs('uploads',$imageName);

        $product = new Product;
        $product->image = $imageName;
        $product->name = $request->name[0];
        $product->description = $request->description;
        $product->category_id = $request->category_id;
        $product->brand_id = $request->brand_id;
        $product->save();

        //
        $stockNames = $request->input('stock');
        //$stockQuantities = $request->input('quantity[]');

        //dd($stockNames);

        foreach ($stockNames as $nm) {
            Stock::create([
                'product_id' => $product->id,
                'name' => $nm['name'],
                'quantity' => $nm['quantity'],
            ]);
        }




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
