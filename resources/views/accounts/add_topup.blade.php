@extends('layouts.app')
@section('title', 'products')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">

                    <div class="card-header">
                        <span class="left">{{ __('All Products') }}</span>
                    </div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <form action="{{route('client.topups.save')}}" method="post" enctype="multipart/form-data" id="create-product-form">
                            @csrf
                            <div class="form-group">
                                <label for="amount">amount($)</label>
                                <input type="number" step="any" class="form-control" name="amount" id="amount" value="{{old('amount')}}">
                            </div>

                            <button class="btn btn-primary my-3" type="submit">Add Topup</button>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <!-- Laravel Javascript Validation -->
    <script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.js')}}"></script>
    {!! JsValidator::formRequest('App\Http\Requests\ProductRequest', '#create-product-form'); !!}
@endsection
