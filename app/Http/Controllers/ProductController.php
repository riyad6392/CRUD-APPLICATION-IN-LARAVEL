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
            'image'=>'required|mimes:jpeg,jpg,png,gif|max:1000',
            'stock.*.name' => 'required|string|max:255',
            'stock.*.quantity' => 'required|integer|min:1'
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
        $stocks = Stock::where('product_id', $id)->get();
        $categoris = Category::all();
        $brand = Brand::all();
        // dd($categoris);
        return view('products.edit',['product'=>$product, 'stocks' => $stocks,'categoris' => $categoris,"brands" => $brand]);
    }

    public function update(Request $request,$id){
        //validate data
        //dd($request);
        $stocks= Stock::all();
        //dd($stocks);
        $request->validate([
            'name'=>'required',
            'description'=>'required',
            'category'=>'required',
            'brand'=>'required',
            'image'=>'nullable|mimes:jpeg,jpg,png,gif|max:1000',
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
        $product->save();



        $stockData = $request->input('stock');
        //dd($stockData);
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

        //dd($DelStockIds);

        // Delete stock entries that are associated with the product but not present in the request
        // $product->stock()->whereNotIn('id', $newStockIds)->delete()
       foreach($stocks as $stock){
           if('product_id'==$stock['id']){
              dd('product_id');
           }

       }


        if ($product->stock()->exists()) {
            $existingStockIds = $product->stocks->pluck('id')->toArray();
            $deletedStockIds = array_diff($existingStockIds, $newStockIds);
            Stock::destroy($deletedStockIds);
        }


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





}
