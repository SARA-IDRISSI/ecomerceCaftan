@extends('main')
@section('title', 'Cordonner client')

@section('content')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/country-select-js/2.1.1/css/countrySelect.min.css"
        integrity="sha512-HHSUgqDtmyVfGT0pdLVRKcktf9PfLMfFzoiBjh9NPBzw94YFTS5DIwZ12Md/aDPcrkOstXBp9uSAOCl5W2/AOQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <section class="row d-flex justify-content-between container mx-auto py-4 mb-4">
        <form action="{{ route('save-user-details') }}" class="row col-7 g-3  shadow-sm p-4" method="POST" style="height:100%">
            @csrf
            <div class="col-md-12">
                <p>Cordonnées</p>
                <label for="inputEmail4" class="form-label">Email</label>
                <input required name="email" type="email" class="form-control" value="{{ Auth::user()->email }}"
                    id="inputEmail4">
            </div>

            <div class="col-md-12">Adresse d'expédition</div>
            <div class="col-md-12">
                <input required name="country" type="text" id="country" class="form-control" />
            </div>
            <div class="col-6">
                <label for="inputAddress" class="form-label">Nom</label>
                <input required name="firstname" value="{{ Auth::user()->firstname }}" type="text" class="form-control"
                    id="inputAddress">
            </div>
            <div class="col-6">
                <label for="inputAddress2" class="form-label">Prénom</label>
                <input required value="{{ Auth::user()->lastname }}" name="lastname" type="text" class="form-control"
                    id="inputAddress2">
            </div>
            <div class="col-md-12">
                <label for="inputEmail4" class="form-label">Adresse</label>
                <input required name="adressLine" value="{{ Auth::user()->adressLine }}" type="text" class="form-control"
                    id="inputEmail4" required>
            </div>
            <div class="col-6">
                <label for="inputAddress" class="form-label">Code Postal</label>
                <input required name="codePostal" value="{{ Auth::user()->codePostal }}" type="text" class="form-control"
                    id="inputAddress">
            </div>
            <div class="col-6">
                <label for="inputAddress2" class="form-label">ville</label>
                <input required name="ville" value="{{ Auth::user()->ville }}" type="text" class="form-control"
                    id="inputAddress2">
            </div>

            <div class="col-12">
                <label for="inputAddress2" class="form-label">Téléphone</label>
                <input name="contactNo" value="{{ Auth::user()->contactNo }}" type="text" class="form-control"
                    id="inputAddress2" required>
            </div>


            <div class="d-flex justify-content-between col-12">
                <div>
                    <a href="/pannier" type="submit" class="btn btn-primary">Retour au pannier</a>
                </div>
                <div>
                    <button type="submit" class="btn btn-primary">Continuer vers l'éxpédition</button>
                </div>
            </div>


        </form>
        <div class="row shadow-sm g-3 col-4" style="height:100%">
            <div class=" row container mx-auto ">

                <div class="col-6 heiight">
                    @foreach (Cart::instance('shopping')->content() as $key => $item)
                        {{-- <th scope="row">{{ (int) $key + 1 }}</th> --}}
                        <img src="/{{ $item->options->photo }}" class="w-75 my-5 mt-0" />
                    @endforeach
                </div>


                <div class="col-6 heiight">
                    @foreach (Cart::instance('shopping')->content() as $key => $item)
                        <div>{{ $item->name }}</div>
                        {{-- <div><a href="{{ route('degrade', ['rowId' => $item->rowId]) }}">-</a>{{ $item->qty }}<a
                                href="{{ route('upgrade', ['rowId' => $item->rowId]) }}">+</a></div> --}}
                        @if ($item->options->category != 'Bijoux')
                            <div>{{ $item->options->size }}</div>

                            <div><input type="color" value="{{ $item->options->color }}" disabled /></div>
                        @endif
                        <div>{{ $item->price }}</div>
                        <div>PT:{{ $item->price * $item->qty }}</div>
                        <div>Q:{{ $item->qty }}</div>
                        <div><a href="{{ route('delete-from-cart', ['rowId' => $item->rowId]) }}"
                                class="text-danger">Delete</a></div>
                        <hr>
                    @endforeach

                </div>
                <div class="col-12 text-end color mt-5"> Prix Total :{{ Cart::instance('shopping')->priceTotal() }}
                    dh</div>
            </div>

        </div>
    </section>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.min.js"
        integrity="sha512-STof4xm1wgkfm7heWqFJVn58Hm3EtS31XFaagaa8VMReCXAkQnJZ+jEy8PCC/iT18dFy95WcExNHFTqLyp72eQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/country-select-js/2.1.1/js/countrySelect.min.js"
        integrity="sha512-criuU34pNQDOIx2XSSIhHSvjfQcek130Y9fivItZPVfH7paZDEdtAMtwZxyPq/r2pyr9QpctipDFetLpUdKY4g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        $("#country").countrySelect({
            defaultCountry: "ma",
        });
    </script>
@endsection
