<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Products;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Symfony\Component\CssSelector\XPath\Extension\FunctionExtension;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Products::where('user_id' , auth()->user()->id)->get();
        return view('products.show' , compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('products.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'product_name'=> 'required|max:255',
            'product_image'=> 'required',
            'product_details'=> 'required|max:255',
            'product_type'=> 'required|max:255',
            'amount'=> 'required|numeric|min_digits:1',
            'price'=> 'required|numeric|min_digits:1',
        ]);
        $image_name = $request->product_image->getClientOriginalName();
        $image_path = $request->product_image->storeAs('products' , $image_name , 'local');
        Products::create([
            'product_name'=> $request->product_name,
            'product_image_path'=>$image_path ,
            'product_details'=>$request->product_details,
            'product_type'=>$request->product_type,
            'amount'=>$request->amount,
            'user_id'=>auth()->user()->id,
            'price'=> $request->price,
        ]);
        return redirect()->route('products.index');
    }

    /**
     * Display the specified resource.
     */
    public function show($type = '')
    {
        if($type !=''){
            $products = Products::where('product_type' , $type)->get();
            return view('welcome' , compact('products'));
        }

        $products = Products::all();
        return view('welcome' , compact('products'));
    }

    public function search(Request $request)
    {
        $products = Products::where('product_name' ,'like' ,"%$request->search%")->get();
        return view('welcome' , compact('products'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $product = Products::find($id);
        return view("products.edit" , compact('product'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request , $id)
    {
        $request->validate([
            'product_name'=> 'required|max:255',
            'product_details'=> 'required|max:255',
            'product_type'=> 'required|max:255',
            'amount'=> 'required|numeric|min_digits:1',
            'price'=> 'required|numeric|min_digits:1',
        ]);

        $product = Products::find($id);
        $product->product_name = $request->product_name;
        $product->product_details = $request->product_details;
        $product->product_type = $request->product_type;
        $product->amount = $request->amount;
        $product->price = $request->price;
        if($request->product_image){
            $image_name = $request->product_image->getClientOriginalName();
            $image_path = $request->product_image->storeAs('products' , $image_name , 'local');
            File::delete(asset('/laravel/storage/images/'.$product->product_image_path));
            $product->product_image_path = $image_path;
        }
        $product->save();
        return redirect()->route('products.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $product = Products::find($id);
        Products::where('id' , $id)->delete();
        File::delete(public_path('images/'.$product->product_image_path));
        return redirect()->route('products.index');
    }
    public function changetoseller(){
        User::where('id' , auth()->user()->id)->update(['type'=>'seller']);
        return redirect()->back();
    }
}
