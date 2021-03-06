<?php

namespace App\Http\Controllers;

use App\Models\Topup;
use App\Models\User;
use Illuminate\Http\Request;

class TopupController extends Controller
{
    public function topups()
    {
        $user = auth()->user();
        if ($user->is_admin) {
            $topups = Topup::paginate(10);
        } else {
            $topups = Topup::where('account_id', '=', $user->account->id)->paginate(10);
        }
        return view('accounts.topup', compact('topups'));
    }
    public function create()
    {
        return view('accounts.add_topup');
    }
    public function store(Request $request)
    {
        $request->validate([
            'amount'=>'required|numeric'
        ]);
        $user = auth()->user();
        $topup =
        Topup::create([
            'account_id' => $user->account->id,
            'amount' => $request->amount
        ]);

        $previous_amount = $user->account->amount;
        $user->account->update(['amount' => $previous_amount + $topup->amount]);

        return redirect()->route('client.topups')->with('status', 'amount topped successfully');
    }
    public function userTopups(User $user)
    {
        $topups = Topup::where('account_id', '=', $user->account->id)->paginate(10);
        return view('accounts.topup', compact('topups'));
    }
}
