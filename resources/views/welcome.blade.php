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
                @forelse($products as $product)
                    <x-product :product="$product" />
                @empty
                        <div class="alert alert-info">
                            No Products!
                        </div>
                @endforelse
            </div>
        </div>
    </div>
@endsection
