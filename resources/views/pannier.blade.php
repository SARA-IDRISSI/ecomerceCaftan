@extends('main')

@section('title', 'home')
@section('content')
    <main>

        <div class="container mx-auto">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Id</th>
                        <th scope="col">Image</th>
                        <th scope="col">Title</th>
                        <th scope="col">Quantité</th>
                        <th scope="col">Taille</th>
                        <th scope="col">Couleur</th>
                        <th scope="col">Prix Unitaire</th>
                        <th scope="col">Prix Total</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach (Cart::content() as $key => $item)
                        <tr>
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
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <a href="/detailProduct/{{ session('last_visited') }}">countinuer tes achats</a>
            {{-- <a href="{{ URL::previous() }}">Back</a> --}}
            <a href="/cordonnerPayer">Buy it
                now</a>
        </div>

    </main>
@endsection
