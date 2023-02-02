@extends('main')

@section('title', 'home')
@section('content')

    <main>

        <section class="container hero_section">
            {{-- debut de caroussel --}}

            <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img src="{{ asset('images/imgCentr1.webp') }}" class="d-block w-100" alt="...">
                        <div class="description-img">
                            <h3>FROM THE SUMMER</h3>
                            <p class="">Lorem ipsum dolor sit amet consectetur adipisicing elit. Placeat corrupti
                                doloremque dolorum sed
                                accusamus ex consequatur eveniet nemo incidunt id, neque voluptas qui amet
                                reiciendis atque.</p>
                            <button>Shop Now</button>

                        </div>
                    </div>
                    <div class="carousel-item">
                        <img src="{{ asset('images/imgCentr1.webp') }}" class="d-block w-100" alt="...">
                    </div>
                    <div class="carousel-item position-relative">
                        <img src="{{ asset('images/imgCentr1.webp') }}" class="d-block w-100" alt="...">

                    </div>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls"
                    data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls"
                    data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
            {{-- fin de caroussel --}}

        </section>

        <section class="about container row mx-auto">

            <h1 class="catg">Categorie</h1>
            @foreach ($categories as $category)
            @endforeach
            <div class="col-6">
                <div class="HIKING box">
                  <a href="/category/1"><img src="{{asset('images/caftanCatg.jpeg')}}" alt="" class="img_shadow img-fluid"></a>
                    <p class="tit-catg">caftan</p>
                </div>
                <div class="CHUKKAS box ">
                   <a href="/category/2"><img src="{{ asset('images/zoomin_2_ef9d9a4a-e169-47d5-bc75-cf3a6c81c844_400x.webp') }}" alt="" class="img_shadow img-fluid"></a>
                    <p class="tit-catg">tkchita</p>
                </div>
            </div>

            <div class="store col-5">
                <img src="{{ asset('images/Shoe_3.webp') }}" alt="" class="imm">
            </div>

        </section>
        <section class="arrivel container">
            <p>NEW ARRIVALS</p>
            @foreach ($products as $product)
            @endforeach
            <div class="container row mx-auto">
                <div class="col-4">
                    <img class="img-fluid" src="{{ asset('images/caftan-vert.webp') }}" alt="" srcset="">
                </div>
                <div class="col-4">
                    <img class="img-fluid" src="{{ asset('images/images.jpeg') }}" alt="" srcset="">
                </div>
                <div class="col-4">
                    <img class="img-fluid" src="{{ asset('images/images2.jpeg') }}" alt="" srcset="">
                </div>
            </div>

        </section>
        <div class="bgSlice container-fluid">

        </div>

        <section class="bestSellers container">
            <p>BEST SELLERS</p>
            @foreach ($products as $product)
            @endforeach

            <div class="container row mx-auto">
                <div class="col-4">
                    <img class="img-fluid" src="{{ asset('images/b1.jpeg') }}" alt="" srcset="">
                </div>
                <div class="col-4">
                    <img class="img-fluid" src="{{ asset('images/b2.jpeg') }}" alt="" srcset="">
                </div>
                <div class="col-4">
                    <img class="img-fluid" src="{{ asset('images/b3.jpeg') }}" alt="" srcset="">
                </div>
            </div>

        </section>

    </main>

@endsection
