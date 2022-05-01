<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Transaction;
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
        $user = auth()->user();
        $userCash =auth()->user()->account->amount;
        //check if user has not bought it before
        $exists = Transaction::query()
        ->where('user_id', $user->id)
            ->where('product_id', $product->id)
            ->first();
            if($exists){
                return back()->with('status','Already Bought This Product!');
            }
        //check if he has enough amount
       elseif ($userCash < $product->totalPrice)
        {
            return back()->with('status','No enough money to buy this Product! <br\> Topup first.');
        }
        //buy product 1.deduct amount 2.create transaction 3.reduce product
        else{
            $userCash = $userCash-$product->totalPrice;
            $user->account->update(['amount'=>$userCash]);

            Transaction::create([
                'product_id' => $product->id,
                'user_id' =>$user->id,
                'amount' =>$product->totalPrice,
                'status'=>'Successfully',
            ]);

            $product->update(['quantity' => $product->quantity - 1]);
            return back()->with('status','Purchase Done Successfully!');
        }

    }
}
