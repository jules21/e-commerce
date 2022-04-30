<?php

namespace App\Http\Controllers\Api;

use App\FileManager;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Http\Resources\ProductResource;
use App\Mail\NewProductMail;
use App\Models\Product;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::paginate(10);
        return response()->json(ProductResource::collection($products), Response::HTTP_OK);
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
                'quantity' => $request->quantity,
                'discount' => $this->getDiscount($request->price)
            ]);

        //mail admin
        \Mail::to(auth()->user())->send(new NewProductMail($product));

        return response()->json(new ProductResource($product), Response::HTTP_OK);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        return response()->json(new ProductResource($product), Response::HTTP_OK);
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

        //store product Details
        $product=
            $product->update([
                'image' => $imageName,
                'name' => $request->name,
                'description' => $request->description,
                'price' => $request->price,
                'quantity' => $request->quantity,
                'discount' => $this->getDiscount($request->price)
            ]);

        //mail admin
        \Mail::to(auth()->user())->send(new NewProductMail($product));

        return response()->json(new ProductResource($product), Response::HTTP_OK);
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
        return response()->json(null, Response::HTTP_OK);

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
}
