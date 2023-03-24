@extends('admin.dashboard')
@section('form')
    <div class="col-10 row   mx-auto mt-4" style="overflow-x: scroll">
        <h1 class="panierTitle mt-5  text-center text-black">Order Detail</h1>
        <p class="mb-2  fs-1"> {{ $order->created_at }}</p>



        @foreach ($order->orderItems as $item)
            <div class="col-12 container row mx-auto">


                <div class="col-6">

                    <img src="/{{ $item->picture }}" alt="" srcset="" class=" mb-3 img-fluid col-7">



                </div>

                <div class="col-6">

                    <p class=" text-uppercase p1 fs-4"> <span class="color"> titre d'article:</span> {{ $item->title }}
                    </p>
                    <p class=" text-uppercase p1 fs-4"> <span class="color">prix:</span> {{ $item->prix_unitaire }}</p>
                    <p class=" text-uppercase p1 fs-4"> <span class="color">qty:</span> {{ $item->qty }}</p>
                    @if ($item->category != 'Bijoux')
                        <p class=" text-uppercase p1 fs-4"> <span class="color">color:</span> <input type="color"
                                name="" value="{{ $item->color }}" id="" disabled></p>
                        <p class=" text-uppercase p1 fs-4"> <span class="color">size:</span> {{ $item->size }}</p>
                    @endif
                    <p class=" text-uppercase p1 fs-4 border ps-2"> <span class="color">prix total:</span>
                        {{ $item->prix_total }}</p>

                </div>
            </div>
        @endforeach
        <hr>
        {{-- <h1 class="text-center brd  py-2 my-3">Info Client</h1>
        <div class="show"> --}}

        <div class="col-12 container row mx-auto ">

            <p class="col-4 fs-4"> <span class="color">Nom Complet :</span>
                {{ $order->user->username . ' ' . $order->user->lastname }}</p>
            <p class="col-4 fs-4"> <span class="color">Numero De Téléphone :</span> {{ $order->user->contactNo }}</p>
            <p class="col-4 fs-4"> <span class="color">Adresse :</span> {{ $order->user->adressLine }}</p>
            <p class="col-4 fs-4"> <span class="color">Code Postal :</span> {{ $order->user->codePostal }}</p>
            <p class="col-4 fs-4"> <span class="color">Email :</span> {{ $order->user->email }}</p>
            <p class="col-4 fs-4"> <span class="color">Pays / Ville</span>
                {{ $order->user->pays . '  ' . $order->user->ville }}</p>

        </div>
    </div>
    </div>
    </div>
@endsection
