<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Repositories\Cart\CartRepository;
use Illuminate\Http\Request;
use App\Models\ProductCategory;
use App\Http\Requests\CartRequest;
use App\Repositories\Cart\CartModelRepository;
use Illuminate\Support\Facades\App;

class CartCotroller extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(CartRepository $cart) //call service brovider
    {

        return view('website.cart',compact('cart'));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(CartRequest $request , CartRepository $cart)
    {
        $product = Product::findOrFail($request->post('product_id'));
        $cart->add($product , $request->post('quantity'));

    }


    /**
     * Update the specified resource in storage.
     */
    public function update(CartRequest $request, CartRepository $cart)
    {
        
        $product = Product::findOrFail($request->post('product_id'));
        $cart->update($product , $request->post('quantity'));

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CartRepository $cart , string $id  )
    {
        $cart->delete($id);

    }
}
