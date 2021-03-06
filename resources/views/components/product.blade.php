<div class="card">
    <img class="card-img-top" style="object-fit: cover;height: 150px; width: 100%" src="{{$product->getImage()}}" alt="Card image cap">
    <div class="card-body">
        <h5 class="card-title">{{$product->name}}</h5>
        <p class="card-text" style="height: 50px; overflow: hidden">{{Str::limit($product->description, 200)}}
            <span class="pl-10">%{{$product->discount}}</span></p>
        <a href="{{route('products.buy', $product->id)}}" class="card-link" style="text-decoration: none">Buy Now</a>
        <a href="#" class="card-link text-dark" style="text-decoration: none">
            <span class="text-decoration-line-through">${{$product->price}}</span>
            <span class="">${{$product->totalPrice}}</span>
        </a>
    </div>
</div>
