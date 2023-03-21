@extends('main')
@section('title', 'Wishlist')
@section('content')
    <main>
        <div class="container row mx-auto">
            <p class="panierTitle my-5 text-center text-black">Liste De Souhaits</p>
            @foreach (Cart::instance('wishlist')->content() as $key => $item)
                <div class=" col-lg-4 col-md-6 mt-5 ">
                    <div class="boxList d-flex ">

                        <div class="imgList pe-0 me-0 ">
                            <a href="/detailProduct/{{ $item->id }}" target="_blank"><img
                                    src="/{{ $item->options->photo }}" class="imgBox" /></a>
                        </div>


                        <div class="descList ps-3 ">
                            <p class="descP pt-3 ">{{ $item->name }}</p>
                            @if ($item->options->prixPromo)
                                <p class="ps-1 fs-5"> <del>{{ $item->options->prix_actuel }}</del>dh <span class="color">
                                        {{ $item->price }} dh</span></p>
                            @else
                                <p class="color fs-5"> <span class="color">{{ $item->price }}dh</span></p>
                            @endif

                        </div>
                        <a href="/delete-from-wishlist/{{ $item->rowId }}" class="iconList">
                            <i class="bi bi-x text-danger fs-5"></i>
                        </a>
                    </div>
                </div>
            @endforeach

        </div>
    </main>
@endsection
