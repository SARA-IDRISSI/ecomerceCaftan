@extends('main')
@section('title', 'Wishlist')
@section('content')
    <main>
        <div class="container mx-auto">
            @foreach (Cart::instance('wishlist')->content() as $key => $item)
                <div class="col-md-3 mt-5 ">
                    <div class="boxList d-flex justify-content-between">
                        <div class="imgList pe-0 me-0 ">
                            <a href=""><img src="/{{ $item->options->photo }}" class="  imgBox" /></a>
                        </div>
                        <div class="descList ps-3 ">
                            <p class="descP pt-3 ">{{ $item->name }}</p>
                            @if ($item->options->prixPromo)
                                <p class="ps-1 fs-3"> <del>{{ $item->options->prix_actuel }}</del>dh <span>
                                        {{ $item->price }} dh</span></p>
                            @else
                                <p class=" color fs-5"> <span>{{ $item->price }}dh</span></p>
                            @endif

                        </div>
                        <a href="/delete-from-wishlist/{{ $item->rowId }}" class="iconList">
                            <i class="bi bi-x text-danger fs-5"></i>
                        </a>
                    </div>
                </div>

                {{-- <tr>
                            <th scope="row">{{ (int) $key + 1 }}</th>
                            <td><img src="/{{ $item->options->photo }}" /></td>
                            <td>{{ $item->name }}</td>
                            <td><a href="{{ route('degrade', ['rowId' => $item->rowId]) }}">-</a>{{ $item->qty }}<a
                                    href="{{ route('upgrade', ['rowId' => $item->rowId]) }}">+</a></td>
                            <td>{{ $item->options->size }}</td>
                            <td><input type="color" value="{{ $item->options->color }}" disabled /></td>
                            <td>{{ $item->price }}</td>
                            <td>{{ $item->price * $item->qty }}</td>
                            <td><a href="{{ route('delete-from-cart', ['rowId' => $item->rowId]) }}">Delete</a></td>
                        </tr> --}}
            @endforeach
        </div>
    </main>
@endsection
