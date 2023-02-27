<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">


    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">

    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/mdb.min.css') }}" />
    <style>
        .dropdown-menu li {
            position: relative;
        }

        .dropdown-menu .dropdown-submenu {
            display: none;
            position: absolute;
            left: 100%;
            top: -7px;
        }

        .dropdown-menu .dropdown-submenu-left {
            right: 100%;
            left: auto;
        }

        .dropdown-menu>li:hover>.dropdown-submenu {
            display: block;
        }
    </style>
    @livewireStyles
</head>

<body>
    <header>
        <nav>
            <nav class="navbar navbar-expand-lg bg-body-tertiary shadow-sm section_nav">
                <div class="container img-header">
                    <a class="navbar-brand" href=""><img src="{{ asset('images/shoe-logo-new_300x300.avif') }}"
                            alt="" class="logo"></a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                        data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                        aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <div class="collapse navbar-collapse d-flex justify-content-end" id="navbarSupportedContent">
                        @livewire('header-search-component')
                        <ul class="navbar-nav me-0 mb-2 mb-lg-0">
                            <li class="nav-item">
                                <a class="nav-link " aria-current="page" href="/">Home</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">A propos</a>
                            </li>
                            <li class="nav-item dropdown dropdown-hover position-static">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                                    data-mdb-toggle="dropdown" aria-expanded="false">
                                    Boutique
                                </a>
                                <!-- Dropdown menu -->
                                <div class="dropdown-menu w-100 mt-5" aria-labelledby="navbarDropdown"
                                    style="border-top-left-radius: 0;
                                                  border-top-right-radius: 0;
                                                ">

                                    <div class="container">
                                        <div class="row my-4">
                                            <div class="col-md-6 col-lg-3 mb-3 mb-lg-0">
                                                @foreach ($categories as $category)
                                                    <div>
                                                        <a class="categTitle hoverCat"
                                                            href="/category/{{ $category->id }}">{{ $category->libeleCateg }}
                                                            @if (count($category->subCategories) > 0)
                                                            @endif
                                                        </a>
                                                    </div>
                                                    @if (count($category->subCategories) > 0)
                                                        <ul class="catgUl">
                                                            @foreach ($category->subCategories as $subCategory)
                                                                <li>
                                                                    <a class="dropdown-item subCatgTitle  hoverCat"
                                                                        href="#">{{ $subCategory->title }}</a>
                                                                </li>
                                                            @endforeach
                                                        </ul>
                                                    @endif
                                                @endforeach
                                            </div>
                                            <div class="col-md-6 col-lg-3 mb-3 mb-lg-0">
                                                <a class="navbar-brand" href=""><img
                                                        src="{{ asset('images/b.webp') }}" alt=""
                                                        class="image-menu">
                                                </a>
                                            </div>
                                            <div class="col-md-6 col-lg-3 mb-3 mb-md-0">
                                                <a class="navbar-brand " href=""><img
                                                        src="{{ asset('images/k.webp') }}" alt=""
                                                        class="image-menu">
                                                </a>
                                            </div>
                                            <div class="col-md-6 col-lg-3">
                                                <a class="navbar-brand " href=""><img
                                                        src="{{ asset('images/t.jpg') }}" alt=""
                                                        class="image-menu"></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="/NewArivals">New Arivals</a>
                            </li>
                            {{-- contact --}}
                            <li class="nav-item">
                                <a class="nav-link" href="/contact">Contact</a>
                            </li>
                            <li class="nav-item dropdown">
                                @if (Auth::check())
                                    <a class="nav-link  dropdown-toggle" href="#" role="button"
                                        data-bs-toggle="dropdown" aria-expanded="false">

                                        <i class="bi bi-person-circle"></i>
                                        <span> Hi, {{ Auth::user()->username }} </span>
                                    </a>
                                @else
                                    <a class="nav-link icon dropdown-toggle" href="#" role="button"
                                        data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="bi bi-person-circle"></i>
                                    </a>
                                @endif
                                <ul class="dropdown-menu">
                                    @if (Auth::check())
                                        <li><a class="dropdown-item" href="{{ route('logout') }}">logOut</a></li>
                                        <li><a class="dropdown-item" href="/dashboard">Profile</a></li>
                                    @else
                                        <li><a class="dropdown-item" href="{{ route('login') }}">login</a></li>
                                    @endif



                                </ul>
                            <li class="nav-item">
                                <a class="nav-link " aria-current="page"
                                    href="/pannier"><span>{{ Cart::instance('shopping')->count() }}</span><i
                                        class="bi bi-cart3"></i></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link " aria-current="page"
                                    href="/wishlist"><span>{{ Cart::instance('wishlist')->count() }}</span><i
                                        class="bi bi-heart"></i></a>
                            </li>
                            </li>

                        </ul>

                    </div>
                </div>
            </nav>
        </nav>
    </header>

    <main style="overflow-x: hidden">
        <div class="container-fluid row">
            <div class="col-2 admin my-3 bg-dark">
                <div class="col-12 mt-5  text-white text-center"><img src="/{{ Auth::user()->image }}"
                        class="image-dash">
                </div>
                <div class="col-12 mt-3 mb-1 fs-1 text-white  text-center">{{ strtoupper(Auth::user()->username) }}
                </div>
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
                            href="/listSubCategory"> &ensp;&ensp;&ensp; <i class="bi bi-grid"></i> SubCatégories</a>
                    </div>
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
            {{ $slot }}
        </div>
    </main>

    <footer>
        @livewireScripts

        <!-- JavaScript Bundle with Popper -->
        <script type="text/javascript" src="{{ asset('js/mdb.min.js') }}"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous">
        </script>

        <script src="https://kit.fontawesome.com/552b1297ac.js" crossorigin="anonymous"></script>
    </footer>
</body>

</html>
