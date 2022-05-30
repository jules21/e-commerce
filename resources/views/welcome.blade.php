@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif
                <div class="row">
                    @forelse($products as $product)
                        <div class="col-md-4 col-lg-3 col-sm-6 my-2">
                            <x-product :product="$product" />
                        </div>
                    @empty
                        <div class="alert alert-info">
                            No Products!
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
@endsection
