@component('mail::message')
# Hello {{auth()->user()->name}},

New Product have been added Successfilly with details below

| Product      | details |
| -----------  | ----------- |
| Name         | {{$product->name}}       |
| Price        | ${{$product->price}}         |

@component('mail::button', ['url' => route('products.show', $product->id)])
Read More
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
