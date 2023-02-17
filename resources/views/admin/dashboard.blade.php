@extends('main')
@section('title', 'admin')
@section('content')

    <main style="overflow-x: hidden">
        <div class="container-fluid row">
            <div class="col-2 admin my-3 bg-dark">
                <div class="col-12 mt-5  text-white text-center"><img src="/{{ Auth::user()->image }}" class="image-dash" alt=""
                        srcset=""></div>
                <div class="col-12 mt-3 mb-1 fs-1 text-white  text-center">{{ strtoupper(Auth::user()->username) }}</div>
                <div class="col-12 mb-3   text-center"><a href="">{{ Auth::user()->email }}</a></div>


                @if (Auth::user()->role == 'admin')
                    <div class="col-12 border-top border-bottom py-5 text-white text-center"><a class="text-white "
                            href="/EditUser">Edit My
                            Profile</a></div>

                    <div class="col-12 border-top border-bottom py-5 text-white text-center"><a class="text-white "
                            href="/listOrder">My
                            Orders</a>
                    </div>

                    <div class="col-12 border-top border-bottom py-5 text-white text-center"><a class="text-white "
                            href="/allProduct">AllProduct</a>
                    </div>

                    <div class="col-12 border-top border-bottom py-5 text-white text-center"><a class="text-white "
                            href="/listCategory">AllCatégories</a></div>
                    <div class="col-12 border-top border-bottom py-5 text-white text-center"><a class="text-white "
                            href="/add-subcategory">AllSubCatégories</a></div>
                @else
                    <div class="col-12 border-top border-bottom py-5 text-white text-center"><a class="text-white "
                            href="/allProduct">My
                            Information</a>
                    </div>
                    <div class="col-12 border-top border-bottom py-5 text-white text-center"><a class="text-white "
                            href="/add-category">My
                            carte</a></div>
                    <div class="col-12 border-top border-bottom py-5 text-white text-center"><a class="text-white "
                            href="/add-subcategory">Product Prefer</a></div>
                @endif
            </div>
            {{-- formulaire ajouter produit --}}
            @yield('form')
        </div>
    </main>

@endsection
