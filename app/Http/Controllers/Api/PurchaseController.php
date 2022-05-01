<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\PurchaseResource;
use App\Models\Product;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PurchaseController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:sanctum');
    }

    public function index(Request $request)
    {
        $transactions = Transaction::all();
        return response()->json(PurchaseResource::collection($transactions), Response::HTTP_OK);
    }
    public function myPurchases(Request $request)
    {
        $transactions = Transaction::where('user_id', $request->user()->id)->get();
        return response()->json(PurchaseResource::collection($transactions), Response::HTTP_OK);
    }

    function buy(Request $request, Product $product)
    {
        $user = $request->user();
        $userCash =$user->account->amount;
        //check if user has not bought it before
        $exists = Transaction::query()
            ->where('user_id', $user->id)
            ->where('product_id', $product->id)
            ->first();
        if($exists){
            return \response()->json(['error'=>'Already Bought This Product!'], Response::HTTP_BAD_REQUEST);
        }
        //check if he has enough amount
        elseif ($userCash < $product->totalPrice)
        {
            return \response()->json(['error'=>'No enough money to buy this Product! Topup first.'], Response::HTTP_BAD_REQUEST);
        }
        //buy product 1.deduct amount 2.create transaction 3.reduce product
        else{
            $userCash = $userCash-$product->totalPrice;
            $user->account->update(['amount'=>$userCash]);

            $transaction =
            Transaction::create([
                'product_id' => $product->id,
                'user_id' =>$user->id,
                'amount' =>$product->totalPrice,
                'status'=>'Successfully',
            ]);

            $product->update(['quantity' => $product->quantity - 1]);
            return \response()->json($transaction, Response::HTTP_OK);
        }

    }
}
