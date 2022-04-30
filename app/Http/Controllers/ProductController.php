<?php

namespace App\Http\Controllers;

use App\FileManager;
use App\Http\Requests\ProductRequest;
use App\Mail\NewProductMail;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::all();
        return view('admin.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.products.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request)
    {
        // process image
        $file = $request->image;
        $dir = FileManager::PRODUCT_IMAGE_PATH;
        $path = $file->store($dir);
        $imageName = str_replace($dir, '', $path);

        //store product Details
       $product=
        Product::create([
            'image' => $imageName,
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'discount' => $this->getDiscount($request->price)
        ]);

        //mail admin
        \Mail::to(auth()->user())->send(new NewProductMail($product));

        return redirect()->route('products.index')->with('status', 'Product Create Successfully');
    }

    public function getDiscount($price)
    {
        if ($price >= 112 && $price<=115)
            return 0.25;
        elseif ($price > 120)
            return  0.50;
        else
            return 0;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        // process image
        $file = $request->image;
        $dir = FileManager::PRODUCT_IMAGE_PATH;
        $path = $file->store($dir);
        $imageName = str_replace($dir, '', $path);

        //update product Details
        $product->update([
                'image' => $imageName,
                'name' => $request->name,
                'description' => $request->description,
                'price' => $request->price,
                'discount' => $this->getDiscount($request->price)
            ]);


        return redirect()->route('products.index')->with('status', 'Product Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('products.index')->with('status', 'Product Deleted Successfully');
    }
}
