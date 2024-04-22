<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\Brand;

class BrandController extends Controller
{
    public function index(){

        $brands = Brand::all(); 
        return view('brands.index', compact('brands'));
      

    }




    public function create(){

        return view('brands.create');
        
    }
    public function store(Request $request){
        //validate data
       /* $request->validate([
            'name'=>'required',
            'description'=>'required',
            'image'=>'required|mimes:jpeg,jpg,png,gif|max:1000'
        ]);*/




        //upload image
        //$imageName=time().'.'.$request->image->extension();

        //$request->image->move(public_path('products'),$imageName);
       // $request->image->storeAs('uploads',$imageName);


        //$product = new product;
        $brand = new Brand;
        //$product->image=$imageName;
        $brand->name=$request->name;
        //$product->description=$request->description;
        $brand->save();
        return back()->withSuccess('brand created !!!!');
    }

    public function edit($id){
        $Brand = Brand::where('id',$id)->first();
        return view('brands.edit',['Brand'=>$Brand]);
    }

    public function update(Request $request,$id){
       

        $Brand = Brand::where('id',$id)->first();


       
        $Brand->name=$request->name;
        $Brand->save();
        return back()->withSuccess('Brand Updated !!!!');
        }

    public function destroy($id){

        $Brand = Brand::where('id',$id)->first();

        $Brand->delete();
        return back()->withSuccess('Brand Deleted !!!!');
    }

       
}
