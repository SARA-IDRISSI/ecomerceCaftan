@extends('main')
@section('title', 'Wishlist')
@section('content')
    <main>
        <div class="container mx-auto">
            @foreach (Cart::instance('wishlist')->content() as $key => $item)
                <div class="col-md-4">
                    <div class="boxList d-flex">
                        <div class="imgList">
                            <a href=""><img src="/{{ $item->options->photo }}" /></a>
                        </div>
                        <div class="descList">
                            <p>{{ $item->name }}</p>
                            @if ($item->options->prixPromo)
                                <p> <del>{{ $item->options->prix_actuel }}</del> <span>
                                        {{ $item->price }}</span></p>
                            @else
                                <p> <span>{{ $item->price }}</span></p>
                            @endif

                        </div>
                        <a href="/delete-from-wishlist/{{ $item->rowId }}" class="iconList">
                            <i class="bi bi-x"></i>
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
