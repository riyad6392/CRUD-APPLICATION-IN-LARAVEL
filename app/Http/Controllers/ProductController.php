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
       // dd($products);
        $stocks=Stock::all();
        return view('products.index', compact('products','stocks'));
    }

    public function dashbord(){
        $products = Product::with(['category:id,name', 'brand:id,name'])->get();
        // dd($products);
         $stocks=Stock::all();
         return view('dashboard', compact('products','stocks'));
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
        //dd($request->file('image')->getError());

        $request->validate([
            'name'=>'required',
            'description'=>'required',
            'price'=> 'required',
            'category_id'=>'required|exists:categories,id',
            'image'=>'required|mimes:jpeg,jpg,png,gif|max:1000',
            'stock.*.name' => 'required|string|max:255',
            'stock.*.quantity' => 'required|integer|min:1'
        ]);


       // dd($request);






        //upload image
        $imageName=time().'.'.$request->image->extension();

        //$request->image->move(public_path('products'),$imageName);
        $request->image->storeAs('uploads',$imageName);

        $product = new Product;
        $product->image = $imageName;
        //$product->image = $request->image;
        $product->name = $request->name;
        $product->description = $request->description;
        $product->price = $request->price;
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
        $stocks = Stock::where('product_id', $id)->get();
        $categoris = Category::all();
        $brand = Brand::all();
        // dd($categoris);
        return view('products.edit',['product'=>$product, 'stocks' => $stocks,'categoris' => $categoris,"brands" => $brand]);
    }

    public function update(Request $request,$id){
        //validate data
       // dd($id);
        $stocks= Stock::where('product_id',$id)->get();
       // dd($stocks);
        $request->validate([
            'name'=>'required',
            'description'=>'required',
            'price'=> 'required',
            'category_id'=>'required',
            'brand_id'=>'required',
            // 'image'=>'nullable|mimes:jpeg,jpg,png,gif|max:1000',
            'stock.*.name' => 'required|string|max:255',
            'stock.*.quantity' => 'required|integer|min:1'
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
        $product->price=$request->price;
        $product->category_id = $request->category_id;
        $product->brand_id = $request->brand_id;

        $product->save();



        $stockData = $request->input('stock');
        //dd($stockData);
        //dd($id);
        $newStockIds = [];
        foreach ($stockData as $stock) {
            $stockId = isset($stock['id']) ? $stock['id'] : null;
            if ($stockId !== null) {
                $newStockIds[] = $stockId;

            }

            Stock::updateOrCreate(['id' => $stockId], [
                'name' => $stock['name'],
                'quantity' => $stock['quantity'],
                'product_id' => $product->id, // Associate the stock entry with the product
            ]);


        }

        $removeStockIds = array_diff($stocks->pluck('id')->toArray(), $newStockIds);

        if($removeStockIds){
            Stock::whereIn('id', $removeStockIds)->delete();
        }

        //dd($newStockIds);

        // foreach($stocks as $stock){
        //         //dd($stock['product_id']);
        //         $kd=$stock['id'];
        //         //dd($kd);
        //         $delId = in_array($kd, $newStockIds) ? 1 : null;

        //         //dd($delId);

        //         if($delId==null){
        //             //dd($kd);
        //             //destroy2($kd);
        //             Stock::destroy($kd);
        //         }



        // }

        //dd($DelStockIds);

        // Delete stock entries that are associated with the product but not present in the request
        // $product->stock()->whereNotIn('id', $newStockIds)->delete()
    //    foreach($stocks as $stock){
    //        if('product_id'==$stock['id']){
    //           dd('product_id');
    //        }

    //    }



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


    // protected function destroy_stock($id)
    // {
    //     $stock = Stock::find($id);

    //     if ($stock) {
    //         $stock->delete();
    //         return back()->withSuccess('Stock entry deleted successfully!');
    //     }

    //     return back()->withErrors('Stock entry not found.');
    // }

    public function destroy2($id){

        $Category = Stock::where('id',$id)->first();

        $Category->delete();
        return back()->withSuccess('Stock Deleted !!!!');
    }

    public function updateProduct(Request $request){
        //validate data

        $product = Product::findOrFail( $request->id );
        $product->name=$request->name;
        $product->description=$request->description;
        $product->price=$request->price;
        $product->category_id = $request->category_id;
        $product->brand_id = $request->brand_id;

        $product->update();





        return back()->withSuccess('product Updated !!!!');
        }


        public function destroyProduct(Request $request){
           // dd($request->id);
            $product = Product::findOrFail( $request->id );

            $imagePath = storage_path('app/public/uploads/' . $product->image);
            if (file_exists($imagePath)) {
             unlink($imagePath);
            }

            $product->delete();
            return back()->withSuccess('product Deleted !!!!');


        }

        public function Stockstore(Request $request){

            $product = new Stock;
            $product->name=$request->name;
            $product->quantity=$request->quantity;
            $product->product_id = $request->product_id;
            $product->save();

        }






}
