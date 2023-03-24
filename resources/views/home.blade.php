@extends('main')
@section('title', 'home')
@section('content')

    <main>

        <section class=" w-100 ">
            <img src="{{ asset('images/image1.webp') }}" class="img-fluid " alt="...">
        </section>




        <section class="container text-black mt-5">
            <p class="text-center font-title">If you love something, wear it all the time... Find things that suit you.
                That's how you
                look
                extraordinary. So Take a look At <span class="glow"> The Best Sales</span></p>
        </section>
        <section class="bestSellers container mt-5">

            <div class="row">
                @foreach ($best_sellers as $best_seller)
                    <div class="col-lg-3 col-md-6 col-xl-3 col-xxl-3">
                        <div class=" position-relative overflow-hidden">
                            <a href="/detailProduct/{{ $best_seller->id }}">

                                <img src="/{{ $best_seller->photo }}" width="100%" class="imgCatgegory">
                                @if ($best_seller->promo != 0)
                                    <span
                                        class="position-absolute text-light top-10 end-0 iconBg rounded-circle p-2">promo</span>
                                @endif

                            </a>
                            <div class="icon_img">
                                <a href="/detailProduct/{{ $best_seller->id }}" class="me-2  iconBg rounded-circle p-2"><i
                                        class="bi bi-eye"></i></a>


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
                                    <p class=""> <del>{{ $best_seller->prix_actuel }}dh</del></p>
                                @else
                                    <p class="price color">{{ $best_seller->prix_actuel }} dh</p>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

        </section>
        <div class="bgSlicee container-fluid text-light  w-100  ">

            <img src="{{ asset('images/SL1_d5806278-928a-411e-ac3e-8bf23f2cfa08_1920x.webp') }}" class="img-fluid "
                alt="...">

        </div>

        <section class="text-center text-black">
            <p class="my-5 font-titlee">ACHETER PAR CATÉGORIE</p>
            <p class="mb-5">Offrir des robes de haute qualité et cela pour un petit prix. Nous nous efforçons de faire de
                vous le centre
                d'attention, où que vous soyez.</p>
        </section>

        <div class=" row container mx-auto">

            @foreach ($categories as $category)
                <div class="col-lg-4 col-md-4 col-xl-4">
                    <div class="content">
                        <a href="/category/{{ $category->id }}" target="_blank">
                            <div class="content-overlay"></div>
                            <img class="content-image" src="/{{ $category->imageCategory }}">

                            <div class="content-details
                                fadeIn-top">
                                <h3>{{ $category->libeleCateg }}</h3>

                            </div>
                        </a>
                    </div>
                </div>
            @endforeach

        </div>

    </main>


@endsection
