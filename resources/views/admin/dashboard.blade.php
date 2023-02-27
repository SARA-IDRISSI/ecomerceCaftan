@extends('main')
@section('title', 'admin')
@section('content')

    <main style="overflow-x: hidden">
        <div class="container-fluid row">
            <div class="col-2 admin my-3 bg-dark">
                <div class="col-12 mt-5  text-white text-center"><img src="/{{ Auth::user()->image }}" class="image-dash">
                </div>
                <div class="col-12 mt-3 mb-1 fs-1 text-white  text-center">{{ strtoupper(Auth::user()->username) }}</div>
                <div class="col-12 mb-3   text-center"><a href="">{{ Auth::user()->email }}</a></div>


                @if (Auth::user()->role == 'admin')
                    <div class="col-12 border-top border-bottom py-5 text-white text-center"><a class="text-white "
                            href="/EditUser"><i class="bi bi-pencil"></i> Edit
                            Profile</a></div>

                    <div class="col-12 border-top border-bottom py-5 text-white text-center"><a class="text-white "
                            href="/listOrder">
                            <i class="bi bi-box-seam"></i> Orders</a>
                    </div>

                    <div class="col-12 border-top border-bottom py-5 text-white text-center"><a class="text-white "
                            href="/allProduct"> <i class="bi bi-cart"></i> Products</a>
                    </div>

                    <div class="col-12 border-top border-bottom py-5 text-white text-center"><a class="text-white "
                            href="/listCategory"><i class="bi bi-grid"></i> Catégories</a></div>
                    <div class="col-12 border-top border-bottom py-5 text-white text-center"><a class="text-white "
                            href="/listSubCategory"> &ensp;&ensp;&ensp; <i class="bi bi-grid"></i> SubCatégories</a></div>
                @else
                    <div class="col-12 border-top border-bottom py-5 text-white text-center"><a class="text-white "
                            href="/allProduct"><i class="bi bi-pencil"></i>
                            profile</a>
                    </div>
                    <div class="col-12 border-top border-bottom py-5 text-white text-center"><a class="text-white "
                            href="/add-category">My <i class="bi bi-cart"></i>
                            carte</a></div>
                    <div class="col-12 border-top border-bottom py-5 text-white text-center"><a class="text-white "
                            href="/add-subcategory"><i class="bi bi-heart"></i> Product Prefer</a></div>
                @endif
            </div>
            {{-- formulaire ajouter produit --}}
            @yield('form')
        </div>
    </main>

@endsection
