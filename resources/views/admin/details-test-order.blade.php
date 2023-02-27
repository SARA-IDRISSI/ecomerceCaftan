@extends('admin.dashboard')
@section('form')
    <div class="col-9 mt-4" style="overflow-x: scroll">
        {{ $order->created_at }}
        {{ $order->user->adressLine }}
        {{ $order->user->codePostal }}

        <table class="table tab_le">


            <tbody>
                @foreach ($order->orderItems as $item)
                    <tr>
                        <td>{{ $item->id }}</td>
                    </tr>

                    <tr>
                        <td> prix: {{ $item->prix_unitaire }}</td>
                    </tr>
                    <tr>
                        <td> prix total: {{ $item->prix_total }}</td>
                    </tr>
                    <tr>
                        <td>qty: {{ $item->qty }}</td>
                    </tr>
                    <tr>
                        <td>picture: <img src="/{{ $item->picture }}" alt="" srcset=""></td>
                    </tr>
                    <tr>
                        <td>date de commande: {{ $item->created_at }}</td>
                    </tr>
                    <tr>
                        <td>titre d'article: {{ $item->title }}</td>
                    </tr>
                    <tr>
                        <td>color: {{ $item->color }}</td>
                    </tr>
                    <tr>
                        <td>size: {{ $item->size }}</td>
                    </tr>
                @endforeach
                </tr>

            </tbody>
        </table>
    </div>
@endsection
