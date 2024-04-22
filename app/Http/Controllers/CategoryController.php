<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\Brand;

class CategoryController extends Controller
{
    public function index(){

        $categories = Category::all(); 
        return view('categories.index', compact('categories'));
      

    }




    public function create(){

        return view('categories.create');
        
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
        $Category = new Category;
        //$product->image=$imageName;
        $Category->name=$request->name;
        //$product->description=$request->description;
        $Category->save();
        return back()->withSuccess('categories created !!!!');
    }

    public function edit($id){
        $Category = Category::where('id',$id)->first();
        return view('categories.edit',['Category'=>$Category]);
    }

    public function update(Request $request,$id){
       

        $Category = Category::where('id',$id)->first();


       
        $Category->name=$request->name;
        $Category->save();
        return back()->withSuccess('category Updated !!!!');
        }

    public function destroy($id){

        $Category = Category::where('id',$id)->first();

        $Category->delete();
        return back()->withSuccess('catagory Deleted !!!!');
    }

       
}
