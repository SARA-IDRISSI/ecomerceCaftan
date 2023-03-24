@extends('main')

@section('title', 'Pannier')
@section('content')
    <main>

        <div class="container row mx-auto">
            <p class="panierTitle my-5 text-center text-black">Panier d'achat</p>
            @foreach (Cart::instance('shopping')->content() as $key => $item)
                <div class="row ">
                    <div class="col-md-3 col-6 mb-5">
                        <img src="/{{ $item->options->photo }}" class="" width="100%" />
                    </div>
                    <div class="col-md-8 mx-auto col-6 mt-4 d-md-flex ">
                        <div>
                            <p class="text-capitalize">{{ $item->name }}</p>
                            @if ($item->options->category != 'Bijoux')
                                <p> <input type="color" value="{{ $item->options->color }}" disabled /> /
                                    {{ $item->options->size }}
                                </p>
                            @endif
                            <div class="my-1">
                                <a href="{{ route('degrade', ['rowId' => $item->rowId]) }}" class="mb-2"><i
                                        class="bi bi-chevron-down text-black"></i></a><span
                                    class="px-4">{{ $item->qty }}</span><a
                                    href="{{ route('upgrade', ['rowId' => $item->rowId]) }}"><i
                                        class="bi bi-chevron-up text-black"></i></a>
                            </div>
                            <p class="mt-3"><a href="{{ route('delete-from-cart', ['rowId' => $item->rowId]) }}"
                                    class="color mt-5">Delete</a>
                            </p>
                        </div>

                        <div class="mx-auto">
                            <p class="fs-5">{{ $item->price * $item->qty }} dh</p>
                        </div>
                    </div>
                </div>
                <hr>

            @endforeach
            <div class="col-12 text-end color mt-5"> Prix Total :{{ Cart::instance('shopping')->priceTotal() }} dh</div>
            <div class="col-4">
                <button class="colo border-0 px-3 py-2 my-1 "> <a href="/detailProduct/{{ session('last_visited') }}"
                        class="colo">Countinuer
                        Mes achats</a>
                </button>
                {{-- <a href="{{ URL::previous() }}">Back</a> --}}
                @if (Cart::instance('shopping')->count() > 0)
                    <button class="colo border-0 px-3 py-2 mt-2 my-1"> <a href="/cordonnerPayer" class="colo">Buy it
                            now</a></button>
                @endif
            </div>
        </div>

        {{--
        <table class="table">

            <tbody>
                @foreach (Cart::content() as $key => $item)
                    <tr>
                        <th scope="row">{{ (int) $key + 1 }}</th>
                        <td><img src="/{{ $item->options->photo }}" class=" w-25 h-25" /></td>
                        <td>{{ $item->name }}</td>
                        <td><a href="{{ route('degrade', ['rowId' => $item->rowId]) }}">-</a>{{ $item->qty }}<a
                                href="{{ route('upgrade', ['rowId' => $item->rowId]) }}">+</a></td>
                        <td>{{ $item->options->size }}</td>
                        <td><input type="color" value="{{ $item->options->color }}" disabled /></td>
                        <td>{{ $item->price }}</td>
                        <td>{{ $item->price * $item->qty }}</td>
                        <td><a href="{{ route('delete-from-cart', ['rowId' => $item->rowId]) }}">Delete</a></td>
                    </tr>
                @endforeach
            </tbody>
        </table> --}}


    </main>
@endsection
