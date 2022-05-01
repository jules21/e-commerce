<div class="card" style="width: 18rem;">
    <img class="card-img-top" src="{{$product->getImage()}}" alt="Card image cap">
    <div class="card-body">
        <h5 class="card-title">{{$product->name}}</h5>
        <p class="card-text">{{Str::limit($product->description, 200)}}
            <span class="pl-10">%{{$product->discount}}</span></p>
        <a href="{{route('products.buy', $product->id)}}" class="card-link" style="text-decoration: none">Buy Now</a>
        <a href="#" class="card-link text-dark" style="text-decoration: none">${{$product->price}}
        </a>
    </div>
</div>
