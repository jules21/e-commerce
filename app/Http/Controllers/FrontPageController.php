<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class FrontPageController extends Controller
{
    function index()
    {
        $products = Product::all();
        return view('welcome',compact('products'));
    }
    function buy(Product $product)
    {
        return $product;
    }
}
