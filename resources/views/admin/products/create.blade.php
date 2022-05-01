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

                            <form action="{{route('products.store')}}" method="post" enctype="multipart/form-data" id="create-product-form">
                                @csrf
                                <div class="form-group">
                                    <label for="image">Image</label>
                                    <input type="file" class="form-control" name="image" id="image">
                                </div>
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input type="text" class="form-control" name="name" id="name" value="{{old('name')}}">
                                </div>
                                <div class="form-group">
                                    <label for="price">price $</label>
                                    <input type="number" step="any" class="form-control" name="price" id="price" value="{{old('price')}}">
                                </div>
                                <div class="form-group">
                                    <label for="quantity">Quantity $</label>
                                    <input type="number" step="any" class="form-control" name="quantity" id="quantity" value="{{old('quantity')}}">
                                </div>
                                <div class="form-group">
                                    <label for="description">description</label>
                                    <textarea class="form-control" name="description" id="description" value="{{old('name')}}">{{old('textarea')}}</textarea>
                                </div>

                                <button class="btn btn-primary my-3" type="submit">Create Product</button>
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
