<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\TopupRequest;
use App\Http\Resources\TopupResource;
use App\Models\Account;
use App\Models\Topup;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TopupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  \App\Models\Account  $account
     * @return \Illuminate\Http\Response
     */
    public function index(Account $account)
    {
        $topups = Topup::where('account_id', $account->id)->get();
        return response()->json(TopupResource::collection($topups), Response::HTTP_OK);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Account  $account
     * @return \Illuminate\Http\Response
     */
    public function store(TopupRequest $request, Account $account)
    {
        $topup = $account->topups()->create($request->all());
        $previous_amount = $account->amount;
        $account->update(['amount' => $previous_amount + $topup->amount]);
        return \response()->json(new TopupResource($topup), Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Account  $account
     * @param  \App\Models\Topup  $topup
     * @return \Illuminate\Http\Response
     */
    public function show(Account $account, Topup $topup)
    {
        return \response()->json(new TopupResource($topup), Response::HTTP_CREATED);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Account  $account
     * @param  \App\Models\Topup  $topup
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Account $account, Topup $topup)
    {
        $topup = $account->topups()->update($request->all());
        return \response()->json(new TopupResource($topup), Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Account  $account
     * @param  \App\Models\Topup  $topup
     * @return \Illuminate\Http\Response
     */
    public function destroy(Account $account, Topup $topup)
    {
        $topup->delete();
        return \response()->json(null, Response::HTTP_OK);
    }
}
