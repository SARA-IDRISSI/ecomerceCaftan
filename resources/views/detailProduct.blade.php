@extends('main')

@section('title', 'Detail-product')
@section('content')
    <section class="container row mx-auto">
        {{-- @if (session('success'))
            <div class="alert">{{ session('success') }}</div>
        @endif --}}
        @if (session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif
        <form class="row mx-auto  mt-5" action="{{ route('pannier') }}" method="post">
            @csrf
            <input type="hidden" name="id" value="{{ $article->id }}" />
            <div class="col-xxl-6 col-lg-6  col-md-12">
                <div id="content-wrapper" class="mx-auto col-xs-11">
                    <div class="column">
                        <div id="img-container">
                            <div id="lens"></div>
                            <img src="/{{ $article->photo }}" id=featured alt="" srcset="" class="w-100">

                            <div id="slide-wrapper">

                                <img id="slideLeft" class="arrow" src="{{ asset('images/arrow-left.png') }}">

                                <div id="slider">

                                    @foreach ($article->imageProducts as $item)
                                        <img class="thumbnail" src="/{{ $item->image }}">
                                    @endforeach

                                </div>
                                <img id="slideRight" class="arrow" src="{{ asset('images/arrow-right.png') }}">

                            </div>
                        </div>

                    </div>
                </div>
            </div>

            <div class=" col-xl-6 ms-xl-0 ms-lg-auto col-lg-5 col-md-12">

                <h2 class="fs-1 mb-4 text-black text-capitalize"> {{ $article->title }}</h2>
                <div class="row">

                    <div class="">
                        <p class="mb-4"> <span>
                                @if ($article->promo == 1)
                                    <p class="price color">{{ $article->prix_promotion }} dh</p>
                                    <p class=""> <del>{{ $article->prix_actuel }} dh</del></p>
                                @else
                                    <p class="price color">{{ $article->prix_actuel }} dh</p>
                                @endif
                        </p>

                        @if ($article->category->libeleCateg !== 'Bijoux')
                            <div class="row gx-5 ms-1">
                                <input type="hidden" value="{{ $article->productSizes[0]->size }}" name="size"
                                    id="size-input" />
                                <div class="row">

                                    @foreach ($article->productSizes as $key => $item)
                                        @if ($item->stock > 0)
                                            <button
                                                onclick="show_hide(event, '{{ $key }}', '{{ $item->size }}')"
                                                class="btnSize mb-4 me-3 col-lg-3 ">
                                                {{ $item->size }}
                                            </button>
                                        @else
                                            <button disabled
                                                onclick="show_hide(event, '{{ $key }}', '{{ $item->size }}')"
                                                class="btnSize btn_disabled position-relative mb-4 col-lg-3 ">
                                                {{ $item->size }}
                                            </button>
                                        @endif
                                        @foreach ($item->colors as $color => $stock)
                                            @if ($stock > 0)
                                                <div class="color-{{ $key }} d-none">
                                                    <input type="radio" value="{{ $color }}" name="color"
                                                        onclick="setStock(event, '{{ $stock }}')" />

                                                    <input type="color" name="color" value="{{ $color }}"
                                                        disabled />
                                                </div>
                                            @else
                                                <div class="color-{{ $key }} position-relative   d-none">
                                                    <input type="radio" class="check_disabled"
                                                        value="{{ $color }}" name="color" disabled />

                                                    <input type="color" class="check_disabled" name="color"
                                                        value="{{ $color }}" disabled />
                                                </div>
                                            @endif
                                        @endforeach
                                        {{-- @if ($this->prodClorsSelectedQuantity == 'outOfStock')
                                                <p class="bg-danger">out stock</p>
                                            @elseif ($this->prodClorsSelectedQuantity > 0)
                                                <p class=" bg-success">in stock</p>
                                            @endif --}}
                                    @endforeach
                                </div>

                            </div>
                        @endif
                    </div>
                </div>
                <div class="mt-4 mb-4">
                    <div class="d-inline row position-relative">

                        <input type="number" value="1" min="1" name="qty" max=""
                            class="number col-xl-4 col-12 p-0 ms-3" id="qty">

                        {{-- <a class="position-absolute bottom-0 mb-2 leftIncr text-dark" wire:click="incrementQuantity"><i
                                class="bi bi-caret-up"></i></a>
                        <a class="position-absolute top-0 leftIncr text-dark" wire:click="decrementQuantity">
                            <i class="bi bi-caret-down"></i></a> --}}
                    </div>

                    <button type="submit" class="hvr-sweep-to-right mx-xl-3 mx-0 my-xl-0 my-2 col-xl-4 col-12  py-2 px-5">
                        Add To Cart </button>
                    <button formaction="/buyNow" class="hvr-sweep-to-rightt col-xl-4 col-12 py-2 px-5">
                        <a href="/cordonnerPayer" class="text-white">
                        </a>Buy Now
                    </button>
                    @if (session('success'))
                        <div class="alert color">{{ session('success') }}</div>
                    @endif


                </div>

                <div class="border-top pt-5 listWish">
                    @php
                        $items = Cart::instance('wishlist')->search(function ($cartItem) use ($article) {
                            return $cartItem->id == $article->id;
                        });
                    @endphp
                    @if (count($items) > 0)
                        <a href="/add-to-wishlist/{{ $article->id }}" class="iconList color">
                            <i class="bi bi-heart-fill"></i>

                            AJOUTER
                            À LA LISTE DE
                            SOUHAITS
                        </a>
                    @else
                        <a href="/add-to-wishlist/{{ $article->id }}" class="iconList color ">
                            <i class="bi bi-heart"></i> AJOUTER À LA LISTE DE
                            SOUHAITS
                        </a>
                    @endif
                </div>

                <div class="mt-5 mb-5 pb-5">
                    <p class="fs-1">DESCRIPTION</p>
                    <p class="bgDesc px-3 py-2">{{ $article->description }}</p>
                </div>
            </div>
            <div class="mt-5 mb-5 pb-5 pt-5"></div>




            <section class="container mt-5 ">
                <p class="text-center pb-5 connex text-black">BEST SELLERS</p>
                <div class="row">
                    @foreach ($best_sellers as $best_seller)
                        <div class="col-lg-3 col-md-6 col-xs-12">
                            <div class=" position-relative overflow-hidden">
                                <a href="/detailProduct/{{ $best_seller->id }}">
                                    <img src="/{{ $best_seller->photo }}" width="100%" class="imgCatgegory">
                                    @if ($best_seller->promo != 0)
                                        <span
                                            class="position-absolute text-light top-10 end-0 iconBg rounded-circle p-2">promo</span>
                                    @endif
                                </a>
                                <div class="icon_img">
                                    <a href="/detailProduct/{{ $best_seller->id }}"
                                        class="me-2  iconBg rounded-circle p-2"><i class="bi bi-eye"></i></a>


                                    @php
                                        $items = Cart::instance('wishlist')->search(function ($cartItem) use ($best_seller) {
                                            return $cartItem->id == $best_seller->id;
                                        });
                                    @endphp
                                    @if (count($items) > 0)
                                        <a href="/add-to-wishlist/{{ $best_seller->id }}"
                                            class="iconList  iconBg rounded-circle p-2">
                                            <i class="bi bi-heart-fill"></i>
                                        </a>
                                    @else
                                        <a href="/add-to-wishlist/{{ $best_seller->id }}"
                                            class="iconList iconBg rounded-circle p-2">
                                            <i class="bi bi-heart"></i>
                                        </a>
                                    @endif
                                </div>
                            </div>
                            <div class="text-center">
                                <h3 class="mt-4">{{ $best_seller->title }}</h3>
                                <div class="d-flex justify-content-around">
                                    @if ($best_seller->promo == 1)
                                        <p class="price color">{{ $best_seller->prix_promotion }} dh</p>
                                        <p class=""> <del>{{ $best_seller->prix_actuel }} dh</del></p>
                                    @else
                                        <p class="price color">{{ $best_seller->prix_actuel }} dh</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </section>
        </form>
    </section>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.min.js"
        integrity="sha512-STof4xm1wgkfm7heWqFJVn58Hm3EtS31XFaagaa8VMReCXAkQnJZ+jEy8PCC/iT18dFy95WcExNHFTqLyp72eQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="{{ asset('js/details.js') }}"></script>
    <script src="{{ asset('js/slider.js') }}"></script>
    <script src="{{ asset('js/scriptt.js') }}"></script>
    <script>
        function setStock(event, stock) {
            let qtyInput = document.getElementById('qty');
            qtyInput.setAttribute("max", stock);
        }
    </script>
@endsection
