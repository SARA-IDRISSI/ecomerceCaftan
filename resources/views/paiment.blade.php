@extends('main')
@section('title', 'HIKING BOOTS')

@section('content')
    @paddleJS
    <main class="container mx-auto">
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        <table class="table">
            <tr>
                <th scope="col">Contact</th>
                <td scope="col">{{ Auth::user()->email }}</td>
                <td scope="col"><a href="{{ URL::previous() }}">Modifier</a></td>
            </tr>

            <tr>
                <th scope="col">Expédier à</th>
                <td scope="col">{{ Auth::user()->adressLine }}</td>
                <td scope="col"><a href="{{ URL::previous() }}">Modifier</a></td>
            </tr>
        </table>

        <div>
            <h1>Paiement</h1>
            <p>Toutes les transactions sont sécurisées et chiffrées.</p>

            <div>
                <div><input type="radio" name="paimentRadio" value="carte"> red</div>
                <div class="carte boxPymnt">
                    <x-paddle-checkout :override="$payLink" width="400" />
                </div>

                <div><input type="radio" name="paimentRadio" value="cod"> green</div>
                {{ $payLink }}
                <div class="cod boxPymnt">
                    <p>Paiement à la Livraison (Valable uniquement au Maroc)
                        Cash on delivery (Available only for Morocco)</p>
                    <a href="{{ route('make-order') }}" class="btn btn-primary">Valider La Commande</a>
                </div>
            </div>

        </div>
    </main>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.min.js"
        integrity="sha512-STof4xm1wgkfm7heWqFJVn58Hm3EtS31XFaagaa8VMReCXAkQnJZ+jEy8PCC/iT18dFy95WcExNHFTqLyp72eQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script>
        $(document).ready(function() {
            $('input[type="radio"]').click(function() {
                var inputValue = $(this).attr("value");
                var targetBox = $("." + inputValue);
                $(".boxPymnt").not(targetBox).hide();
                $(targetBox).show();
            });
        });
    </script>
@endsection
