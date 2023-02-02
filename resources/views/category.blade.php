@extends('main')
@section('title','HIKING BOOTS')
@section('content')

  <main>
<p class="text-center fs-1">CAFTAN</p>
<div class="container row gx-1 mx-auto gy-5">
    @foreach ($category->products as $product )
    <div class="col-3">
    <div class="card">
        <a href="/detailProduct/{{ $product->id }}">
            <img src="/{{ $product->photo }}" class="img-boot-catg img-fluid">

        </a>
        <h1>{{ $product->title }}</h1>
        <p class="price">${{ $product->prix_promotion }}</p>
        <p><button>Acheter</button></p>
    </div>
</div>
    @endforeach
{{--

  <div class="col-3">
    <div class="card">
        <img src="{{ asset('images/caftan-elena-fuchsia.jpg') }}" alt="Denim Jeans" class="img-boot-catg img-fluid">
        <h1>caftan elena</h1>
        <p class="price">$19.99</p>
        <p><button>Acheter</button></p>
    </div>
  </div>
  <div class="col-3">
    <div class="card">
        <img src="{{ asset('images/caftan-amani-green.jpg') }}" alt="Denim Jeans" class="img-boot-catg img-fluid">
        <h1>caftan amani</h1>
        <p class="price">$19.99</p>
        <p><button>Acheter</button></p>
    </div>
  </div>
  <div class="col-3">
    <div class="card">
        <img src="{{ asset('images/caftan-farah-insectevert.jpg') }}" alt="Denim Jeans" class="img-boot-catg img-fluid">
        <h1>caftan farah</h1>
        <p class="price">$19.99</p>
        <p><button>Acheter</button></p>
    </div>
  </div>
  <div class="col-3">
    <div class="card">
        <img src="{{ asset('images/caftan-farah-oxford-blue.jpg') }}" alt="Denim Jeans" class="img-boot-catg img-fluid">
        <h1>caftan farah blue</h1>
        <p class="price">$19.99</p>
        <p><button>Acheter</button></p>
    </div>
  </div>
  <div class="col-3">
    <div class="card">
        <img src="{{ asset('images/caftan-maya-royal-blue.jpg') }}" alt="Denim Jeans" class="img-boot-catg img-fluid">
        <h1>caftan maya</h1>
        <p class="price">$19.99</p>
        <p><button>Acheter</button></p>
    </div>
  </div>
</div> --}}
  </main>
  @endsection


