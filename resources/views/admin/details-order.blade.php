@extends('admin.dashboard')
@section('form')
    <div class="col-10 row   mx-auto mt-4" style="overflow-x: scroll">
        <h1 class="text-center brd py-3 my-3">Info Product</h1>
        <div class="col-10  row mx-auto">
            @foreach ($order->orderItems as $item)
                <div class="col-6  ps-0 shadow row mx-auto">
                    <div class="col-6 ">
                        <div>
                            <img src="/{{ $item->picture }}" alt="" srcset="" class="ms-0">
                        </div>


                    </div>

                    <div class="col-6">
                        <p>titre d'article: {{ $item->title }}</p>
                        <p> prix: {{ $item->prix_unitaire }}</p>
                        <p>qty: {{ $item->qty }}</p>
                        <p>color: <input type="color" name="" value="{{ $item->color }}" id=""></p>
                        <p>size: {{ $item->size }}</p>
                        <p> prix total: {{ $item->prix_total }}</p>

                    </div>
                </div>
            @endforeach

            <h1 class="text-center brd  py-2 my-3">Info Client</h1>
            <div class="show">
                <div class="col-10 mx-auto">


                    <div class=" w-25 text-center mx-auto">
                        <img src="/{{ $order->user->image }}" alt="user" srcset=""
                            class="  rounded-circle img-fluid">

                    </div>
                </div>
                <div class="col-12 row container mx-auto">

                    <p class="col-4 "> {{ $order->created_at }}</p>
                    <p class="col-4"> {{ $order->user->username . ' ' . $order->user->lastname }}</p>
                    <p class="col-4"> {{ $order->user->contactNo }}</p>
                    <p class="col-4"> {{ $order->user->adressLine }}</p>
                    <p class="col-4"> {{ $order->user->codePostal }}</p>
                    <p class="col-4"> {{ $order->user->email }}</p>
                    <p class="col-4"> {{ $order->user->pays . '  ' . $order->user->ville }}</p>

                </div>
            </div>
        </div>
    </div>
@endsection
