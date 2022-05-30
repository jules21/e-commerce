@extends('layouts.app')
@section('title', 'products')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">

                    <div class="card-header">
                        <span class="left">{{ __('All Transactions') }}</span>
                    </div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        @if($transactions->count() > 0)
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                    <tr>
                                        <th>Client</th>
                                        <th>Product Image</th>
                                        <th>Product Name</th>
                                        <th>Price</th>
                                        <th>discount</th>
                                        <th>Date</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($transactions as $transaction)
                                        <tr>
                                            <td>{{$transaction->user->name}}</td>
                                            <td><img src="{{optional($transaction->product)->getImage()}}" width="100" height="100" alt="no image"></td>
                                            <td>{{optional($transaction->product)->name}}</td>
                                            <td>{{$transaction->amount}}</td>
                                            <td>{{optional($transaction->product)->discount}}</td>
                                            <td>{{$transaction->created_at}}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                            {{$transactions->links()}}
                        @else
                            <div class="alert alert-info">
                                No Purchase Done Yet!
                            </div>
                        @endif

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
