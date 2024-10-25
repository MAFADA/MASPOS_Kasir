<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request, $category = null)
    {
        if (!auth()->check() && $request->expectsJson()) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        $categories = Category::all();

        $data = Product::query();

        if ($category) {
            $data->where('category_id', $category);
        }

        $products = $data->get();

        if ($request->expectsJson()) {
            return response()->json($products);
        }

        return view('dashboard', compact('products', 'categories'));
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

    public function delete($id)
    {
        $product = Product::find($id);
        if ($product) {
            $product->delete();
            return response()->json(['success' => 'Product deleted successfully.']);
        }
        return response()->json(['error' => 'Product not found.']);

    }
}
