<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $data = Product::query();

        if ($request->has('category_id') && $request->category != '') {
            $data->where('category_id', $request->category_id);
        }

        $products = $data->get();
        return response()->json($products);
    }

    public function create()
    {
        $categories = Category::all();
        return view('kasir.addProduct', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'product_name' => 'string|max:255',
            'price' => 'numeric',
            'category_id' => 'required|exists:categories,id',
            'image' => 'nullable|file|mimes:jpeg,png,jpg|max:5000',
        ]);

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('product-images', 'public');
        } else {
            $imagePath = null;
        }

        try {
            Product::create([
                'product_name' => $request->product_name,
                'price' => $request->price,
                'category_id' => $request->category_id,
                'image' => $imagePath,
            ]);

            return redirect()->route('dashboard')->with('success', 'Add product successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Add product failed, please try again');
        }
    }
}
