<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CartController extends Controller
{
    public function create()
    {
        return view('kasir.cart');
    }

    public function store(Request $request)
    {

    }

}
