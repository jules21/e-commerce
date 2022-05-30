<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = auth()->user();
        if ($user->is_admin) {
            $transactions = Transaction::paginate(10);
        } else {
            $transactions = Transaction::where('user_id','=', $user->id)->paginate(10);
        }
        return view('transactions.all_transactions', compact('transactions'));
    }
    public function userPurchases(User $user)
    {
        $transactions = Transaction::where('user_id','=', $user->id)->paginate(10);
        return view('transactions.all_transactions', compact('transactions'));
    }

}
