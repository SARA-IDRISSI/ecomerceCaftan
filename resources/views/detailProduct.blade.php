@extends('main')

@section('title', 'home')
@section('content')
    <section class="container row mx-auto">
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif
        <form class="row mx-auto" action="{{ route('pannier') }}" method="post">
            @csrf
            <input type="hidden" name="id" value="{{ $article->id }}" />
            <div class="col-6">
                <img src="/{{ $article->photo }}" alt="" srcset="" class="img-fluid img-detail">

            </div>

            <div class="col-6">

                <h2> {{ $article->title }}</h2>
                <div class="row">
                    <div class="col-6">
                        <p>Price</p>
                        <p>pricePromo</p>
                        <p>Size</p>
                        <p>Color</p>
                        <p>description</p>



                    </div>
                    <div class="col-6">
                        <p>{{ $article->prix_actuel }}</p>
                        <p>{{ $article->prix_promotion }}</p>
                        <div class="row">
                            <input type="hidden" value="{{ $article->productSizes[0]->size }}" name="size"
                                id="size-input" />
                            @foreach ($article->productSizes as $key => $item)
                                <div class="col-4">
                                    <button onclick="show_hide(event, '{{ $key }}', '{{ $item->size }}')">
                                        <a href=""> {{ $item->size }}</a>
                                    </button>
                                    @foreach ($item->colors as $color => $stock)
                                        <div class="color-{{ $key }} d-none">
                                            <input type="radio" value="{{ $color }}" name="color" />
                                            <input type="color" name="color" value="{{ $color }}" disabled />
                                        </div>
                                    @endforeach
                                </div>
                            @endforeach
                        </div>

                        <p>{{ $article->description }}</p>
                    </div>
                </div>
                <input type="number" value="1" min="1" name="qty"> <button type="submit">Add to
                    cart</button>

                <button formaction="/buyNow">Buy it
                    now</button>

            </div>

        </form>
    </section>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.min.js"
        integrity="sha512-STof4xm1wgkfm7heWqFJVn58Hm3EtS31XFaagaa8VMReCXAkQnJZ+jEy8PCC/iT18dFy95WcExNHFTqLyp72eQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="{{ asset('js/details.js') }}"></script>

@endsection
