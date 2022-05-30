@extends('layouts.app')
@section('title', 'products')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">

                    <div class="card-header d-flex justify-content-between align-items-center">
                        <span class="left">{{ __('All Products') }}</span>
                        <a href="{{route('products.create')}}" class="btn btn-primary align-self-end ml-10 right">Add Product</a>
                    </div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        @if($products->count() > 0)
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th>Image</th>
                                <th>Name</th>
                                <th>Description</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>discount</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($products as $product)
                                <tr>
                                    <td><img src="{{$product->getImage()}}" width="100" height="100" alt="no image"></td>
                                    <td>{{$product->name}}</td>
                                    <td>{{$product->description}}</td>
                                    <td>{{$product->price}}</td>
                                    <td>{{$product->quantity}}</td>
                                    <td>{{$product->discount}}</td>
                                    <td>
                                        <a href="{{route('products.edit', $product->id)}}" class="btn btn-warning">Edit</a>
                                        <a href="{{route('products.destroy', $product->id)}}" class="btn btn-danger btn-delete">Delete</a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                            @else
                            <div class="alert alert-info">
                                No Product Added Yet!
                            </div>
                        @endif

                    </div>
                </div>
                <form method="post" id="delete-form" class="hide">
                    @csrf
                    @method('DELETE')
                </form>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
<script>
    $(document).on('click', '.btn-delete', function(e){
        e.preventDefault();
        let btn = $(this);
        let link = btn.attr('href');
        swal.fire({
            title:'are you sure?',
            text : 'This Product Will Be delete. No Revert!',
            icon: 'warning',
            showConfirmButton:true,
            showCancelButton:true
        }).then((result) =>{
            if(result.isConfirmed)
            {
                // submit delete form
                let form = $('#delete-form');
                form.attr('action', link);
                form.submit();

            }
        })
    })
</script>

@endsection
