<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function create()
    {
        return view('kasir.addCategories');
    }

    public function store(Request $request)
    {

    }
}
