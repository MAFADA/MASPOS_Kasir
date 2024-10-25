<?php

namespace App\Http\Controllers;

use App\Models\Order;
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

    public function checkout()
    {
        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return redirect()->back()->with('error', 'Cart is empty!');
        }

        // dd($cart);

        $totalPricePayment = array_reduce($cart, function ($total, $item) {
            return $total + ($item['price'] * $item['qty']);
        }, 0);



        $order = Order::create([
            'UID' => auth()->id(),
            'total' => $totalPricePayment
        ]);

        foreach ($cart as $productID => $item) {
            $order->order_products()->create([
                'product_id' => $productID,
                'qty' => $item['qty'],
                'price' => $item['price'],
            ]);
        }

        session()->forget('cart');
        session()->forget('totalBill');

        return redirect()->route('cart.paymentSuccess', ['totalPricePayment' => $totalPricePayment]);
    }

    public function showPayementSuccess(Request $request)
    {
        $totalPricePayment = $request->query('totalPricePayment', 0);
        return view('kasir.paymentSuccess', compact('totalPricePayment'));
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

        $totalBill = 0;
        foreach ($cart as $item) {
            $totalBill += $item['price'] * $item['qty'];
        }

        session()->put('totalBill', $totalBill);

        return response()->json(['success' => 'Product added to cart successfully!', 'totalBill' => $totalBill]);
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
