<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;

class ProductController extends Controller
{
    // This method will show the products page 

    public function index() {
        $products = Product::orderBy('created_at','DESC')->get();
        return view('products.product',[
            "products"=>$products
        ]);
    } 

    // This method will show create product page 
    public function create(){
        return view('products.createProduct');
    }

    //This method will store a product in db
    public function store(Request $request) {
        $request->validate([
            "name"=>'required|min:5',
            "sku"=>'required|min:3',
            'price'=>'required|numeric',
            'description'=>'required',
            'file' =>'required'
        ]);

        if($request->file !=''){
            $rules['file'] ='file';
        }

        // $validator = Valdiator::make($request->all(),$rules);
        // if($validator->fails()) {
        //     return redirect()->route('products.createProduct')->withInput()->withErrors($validator);
        // }
        // here add products in the database 
        $product = new Product();
        $product->name = $request->name;
        $product->sku = $request->sku;
        $product->price = $request->price;
        $product->description = $request->description;
        #$product->file = $request->file;
        $product->save();

        // add image in db 
        if($request->file !=''){
            $image = $request->file;
            $ext = $image->getClientOriginalExtension();
            $imageName =time().'.'.$ext;
            $product->image = $imageName;
            $product->save();
            // save images in the products folders in the public directory
            $image->move(public_path('uploads/products'), $imageName);
        }

        return redirect()->route('products.index')->with('success','Product Added Successfully.!!');

        #return view('products.product');   
    }

    // This method will show edit the product page
    public function edit($id) {
        $product = Product::findOrFail($id);
        return view('products.edit',["product"=>$product]);

    }
    //This method will show the update the product page
    public function update($id, Request $request) {
        $product = Product::findOrFail($id);
        $request->validate([
            "name"=>"required|min:5",
            "sku"=>"required|min:3",
            "price"=>"required|numeric",
             "description"=>'required',
            "file" =>'required'
        ]);
        if($request->file !=''){
            $rules['file'] ='file';
        }
        // here update products in the database 
        #$product = new Product();
        $product->name = $request->name;
        $product->sku = $request->sku;
        $product->price = $request->price;
        $product->description = $request->description;
        #$product->file = $request->file;
        $product->save();
         // add image in db 
         if($request->file !=''){
            // delete old image
            File::delete(public_path('uploads/products/'.$product->image));
            $image = $request->file;
            $ext = $image->getClientOriginalExtension();
            $imageName =time().'.'.$ext;
            $product->image = $imageName;
            $product->save();
            // save images in the products folders in the public directory
            $image->move(public_path('uploads/products'), $imageName);
        }

        return redirect()->route('products.index',$product->id)->with('success','Product Update Successfully.!!');


    }

    //This method will show delete the prduct 
    public function destroy($id) {
        $product = Product::findOrFail($id);
        // delete image
        File::delete(public_path('uploads/products/'.$product->image));
        // delete product
        $product->delete();
        return redirect()->route('products.index',$product->id)->with('success','Product Deleted Successfully.!!');

    }
}
