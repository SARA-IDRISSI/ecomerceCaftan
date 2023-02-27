@extends('main')

@section('title', 'home')
@section('content')
    <section class="container row mx-auto">
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif
        <form class="row mx-auto  mt-5" action="{{ route('pannier') }}" method="post">
            @csrf
            <input type="hidden" name="id" value="{{ $article->id }}" />
            <div class="col-6">
                <img src="/{{ $article->photo }}" alt="" srcset="" class="img-fluid img-detail">

            </div>

            <div class="col-6">

                <h2 class="fs-1 mb-4 text-black text-capitalize"> {{ $article->title }}</h2>
                <div class="row">

                    <div class="col-6">
                        <p class="mb-4 roseG"> <span>{{ $article->prix_actuel }}</span>
                            <span>{{ $article->prix_promotion }}</span>dh
                        </p>

                        <div class="row">
                            <input type="hidden" value="{{ $article->productSizes[0]->size }}" name="size"
                                id="size-input" />
                            @foreach ($article->productSizes as $key => $item)
                                <div class="col-4">
                                    <button onclick="show_hide(event, '{{ $key }}', '{{ $item->size }}')"
                                        class="btnSize mb-4">
                                        <a href="" class="text-black"> {{ $item->size }}</a>
                                    </button>
                                    @foreach ($item->colors as $color => $stock)
                                        <div class="color-{{ $key }} d-none">
                                            <input type="radio" value="{{ $color }}" name="color" />

                                            <input type="color" name="color" value="{{ $color }}" disabled />
                                        </div>
                                    @endforeach

                                </div>
                            @endforeach

                        </div>


                    </div>
                </div>
                <div class="mt-4 mb-4">
                    <input type="number" value="1" min="1" name="qty" class="number"> <button
                        type="submit" class="hvr-sweep-to-right mx-3 py-2 px-5"> <a href="/pannier" class="text-white"> Add
                            to
                            cart </a></button>

                    <button formaction="/buyNow" class="hvr-sweep-to-rightt  py-2 px-5">Buy it
                        now</button>
                </div>

                <div class="border-top pt-5 listWish">
                    <a href="" class="listWish"><i class="bi bi-heart"></i> AJOUTER À LA LISTE DE SOUHAITS</a>
                </div>
                <div class="mt-5 mb-5 pb-5">
                    <p class="fs-1">DESCRIPTION</p>
                    <p class="bgDesc ps-2">{{ $article->description }}</p>
                </div>
            </div>
            <div class="mt-5 mb-5 pb-5 pt-5"></div>
            <div class="mt-5 mb-5 pb-5 pt-5"></div>



            <section class="container mt-5 pt-5">
                <p class="text-center pb-5 connex text-black">BEST SELLERS</p>
                <div class="row">
                    @foreach ($best_sellers as $best_seller)
                        <div class="col-3">
                            <div class="card">
                                <a href="/detailProduct/{{ $best_seller->id }}">
                                    <img src="/{{ $best_seller->photo }}" class="img-boot-catg img-fluid">
                                    @if ($best_seller->promo != 0)
                                        <span>promo</span>
                                    @endif
                                </a>

                                <h1>{{ $best_seller->title }}</h1>
                                @if ($best_seller->promo == 1)
                                    <p class="price">${{ $best_seller->prix_promotion }}</p>
                                    <p class="price">${{ $best_seller->prix_actuel }}</p>
                                @else
                                    <p class="price">${{ $best_seller->prix_actuel }}</p>
                                @endif
                                @php
                                    $items = Cart::instance('wishlist')->search(function ($cartItem) use ($best_seller) {
                                        return $cartItem->id == $best_seller->id;
                                    });
                                @endphp
                                @if (count($items) > 0)
                                    <a href="/add-to-wishlist/{{ $best_seller->id }}" class="iconList bg-danger">
                                        <i class="bi bi-heart"></i>
                                    </a>
                                @else
                                    <a href="/add-to-wishlist/{{ $best_seller->id }}" class="iconList">
                                        <i class="bi bi-heart"></i>
                                    </a>
                                @endif
                                <p><button>Acheter</button></p>
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

@endsection
