<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Products;
use App\Models\User;
use Illuminate\Http\Request;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = User::find(auth()->user()->id)->products_cart;
        foreach($products as $product){
            if($product->amount < $product->pivot->amount){
                $cart = Cart::find($product->pivot->id)->update(['amount'=>$product->amount]);
            }
        }
        $products = User::find(auth()->user()->id)->products_cart;
        return view('carts' , compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request , $id)
    {
        $cart = Cart::where('user_id' ,auth()->user()->id)
        ->where('products_id' , $id)->get();
        if(count($cart) != 0){
            $cart[0]->update([
                'amount'=>$request->amount
            ]);
            return redirect('/carts/show');
        }
        Cart::create([
            'user_id'=>auth()->user()->id,
            'products_id'=>$id,
            'amount'=>$request->amount
        ]);
        return redirect('/carts/show');
    }

    /**
     * Display the specified resource.
     */
    public function show(Cart $cart)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Cart $cart)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Cart $cart)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($product_id)
    {
        Cart::where('products_id' ,$product_id)
        ->where('user_id' , auth()->user()->id)->delete();
        return redirect()->route('carts.index');
    }
}
