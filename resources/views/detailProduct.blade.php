@extends('main')

@section('title', 'home')
@section('content')
    <section class="container row mx-auto">

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

                    @foreach($article->productSizes as $item)


                    <button><a href=""> {{ $item->size }}</a></button>



            @endforeach
<p></p>
      @foreach($article->productSizes as $item)
      
    <a href=""><input type="color" value="{{ $item->color }}" disabled /></a>




        @endforeach

        <p>{{ $article->description }}</p>
                </div>
            </div>
            <input type="number" value="1">  <button>Add to cart</button> <button>Buy it now</button>

        </div>


    </section>
@endsection
