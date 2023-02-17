@extends('main')
@section('title', 'NewArivals')
@section('content')
    <main>


        <div class="container row gx-1 mx-auto gy-5">
            <h1>New Arivals</h1>
            {{-- @if ($message)
                <h4>{{ $message }}</h4>
            @endif --}}
            @foreach ($products as $product)
                <div class="col-3">
                    <div class="card">
                        <a href="/detailProduct/{{ $product->id }}">
                            <img src="/{{ $product->photo }}" class="img-boot-catg img-fluid">
                            @if ($product->promo != 0)
                                <span>promo</span>
                            @endif
                        </a>

                        <h1>{{ $product->title }}</h1>
                        @if ($product->promo == 1)
                            <p class="price">${{ $product->prix_promotion }}</p>
                            <p class="price">${{ $product->prix_actuel }}</p>
                        @else
                            <p class="price">${{ $product->prix_actuel }}</p>
                        @endif
                        @php
                            $items = Cart::instance('wishlist')->search(function ($cartItem) use ($product) {
                                return $cartItem->id == $product->id;
                            });
                        @endphp
                        @if (count($items) > 0)
                            <a href="/add-to-wishlist/{{ $product->id }}" class="iconList bg-danger">
                                <i class="bi bi-heart"></i>
                            </a>
                        @else
                            <a href="/add-to-wishlist/{{ $product->id }}" class="iconList">
                                <i class="bi bi-heart"></i>
                            </a>
                        @endif
                        <p><button>Acheter</button></p>
                    </div>
                </div>
            @endforeach
        </div>

    </main>
@endsection
