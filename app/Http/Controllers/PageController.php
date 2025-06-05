<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function form()
    {
        return view('form');
    }
    
    public function about()
    {
        return view('about');
    }
    public function main()
    {
        return view('layouts.main');
    }

    public function edit($id)
    {
        $product = Product::findOrFail($id);
        return view('edit_product',compact('product'));
    }
}
