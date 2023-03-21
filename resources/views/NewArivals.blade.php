@extends('main')
@section('title', 'NewArivals')
@section('content')
    <main>


        <div class="container row gx-1 mx-auto gy-5">
            <h1 class=" text-black  mt-5 titleDashboard fs-1">Exclusif</h1>
            {{-- @if ($message)
                <h4>{{ $message }}</h4>
            @endif --}}
            @foreach ($products as $product)
                <div class="col-5">
                    <div class=" position-relative overflow-hidden">
                        <a href="/detailProduct/{{ $product->id }}">
                            <img src="/{{ $product->photo }}" width="100%" class="imgCatgegory">
                            @if ($product->promo != 0)
                                <span
                                    class="position-absolute text-light top-10 end-0 iconBg rounded-circle p-2">Promo</span>
                            @endif
                        </a>


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

                    </div>
                </div>
                <div class="text-center">
                    <h3 class="mt-2">{{ $product->title }}</h3>
                    <div class="d-flex justify-content-around">
                        @if ($product->promo == 1)
                            <p class="price color"> {{ $product->prix_promotion }} dh</p>
                            <p class="price"><del> {{ $product->prix_actuel }} dh</del></p>
                        @else
                            <p class="price color"> {{ $product->prix_actuel }} dh</p>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>


    </main>
@endsection
