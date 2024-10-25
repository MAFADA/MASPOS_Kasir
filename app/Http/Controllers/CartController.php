<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function show()
    {
        $cart = session()->get('cart', []);
        // dd($cart);
        return view('kasir.cart', compact('cart'));
    }

    public function store(Request $request, $productID)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$productID])) {
            $cart[$productID]['qty']++;
        } else {
            $product = Product::find($productID);
            $cart[$productID] = [
                'name' => $product->product_name,
                'qty' => 1,
                'price' => $product->price,
                'image' => $product->image
            ];
        }

        session()->put('cart', $cart);

        return response()->json(['success' => 'Product added to cart successfully!']);
    }

    public function update(Request $request)
    {
        $cart = session()->get('cart');

        if (isset($cart[$request->productID])) {
            if ($request->qty > 0) {
                $cart[$request->productID]['qty'] = $request->qty;
            } else {
                unset($cart[$request->productID]);
            }
        }

        session()->put('cart', $cart);

        return response()->json(['success' => 'Cart updated successfully']);
    }


}
