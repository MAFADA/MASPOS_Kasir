<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function create()
    {
        return view('kasir.addCategories');
    }

    public function store(Request $request)
    {
        $validateData = $request->validate([
            'category_name' => 'string|max:255',
        ]);

        // dd($validateData);

        try {
            Category::create($validateData);

            return redirect()->route('dashboard')->with('success', 'Add category successfully');

        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Add category failed, please try again');
        }

    }
}
