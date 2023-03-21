<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    <link href="https://fonts.cdnfonts.com/css/butler" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="icon" type="image/x-icon" href="{{ asset('images/shoe-logo-new_300x300.avif') }}">



    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">

    <!-- CSS only -->
    {{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous"> --}}
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
</head>

<body>
    <header>
        <nav>
            <nav class="navbar navbar-expand-xl bg-body-tertiary shadow-sm section_nav">
                <div class="container-xl container-md container-sm container-xs img-header">
                    <a class="navbar-brand" href="/"><img src="{{ asset('images/shoe-logo-new_300x300.avif') }}"
                            alt="" class="logo"></a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                        data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                        aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <div class="collapse navbar-collapse " id="navbarSupportedContent">
                        {{-- <form class="d-flex mx-auto " role="search">
                            <input class="form-control me-2 " type="search" placeholder="Search" aria-label="Search">
                            <button class="btn btn-outline-success" type="submit">Search</button>
                        </form> --}}
                        @livewire('header-search-component')
                        <ul class="navbar-nav me-0 mb-2 mb-lg-0">
                            <li class="nav-item">
                                <a class="nav-link " aria-current="page" href="/">Accueil</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="/propos">A propos</a>
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
                                            <div class="col-md-6 col-lg-3  mb-lg-0">
                                                @foreach ($categories as $category)
                                                    <div>
                                                        @if (count($category->subCategories) > 0)
                                                            <span
                                                                class="categTitle hoverCat">{{ $category->libeleCateg }}
                                                            </span>
                                                        @else
                                                            <a class="categTitle hoverCat disabled"
                                                                href="/category/{{ $category->id }}">{{ $category->libeleCateg }}
                                                            </a>
                                                        @endif
                                                    </div>
                                                    @if (count($category->subCategories) > 0)
                                                        <ul class="catgUl">
                                                            @foreach ($category->subCategories as $subCategory)
                                                                <li>
                                                                    <a class="dropdown-item subCatgTitle hoverCat"
                                                                        href="/sub-category/{{ $subCategory->id }}">{{ $subCategory->title }}</a>
                                                                </li>
                                                            @endforeach
                                                        </ul>
                                                    @endif
                                                @endforeach
                                            </div>
                                            <div class="col-md-12 col-lg-3 mb-3 mb-lg-0">
                                                <a class="navbar-brand" href=""><img
                                                        src="{{ asset('images/b.webp') }}" alt=""
                                                        class="image-menu">
                                                </a>
                                            </div>
                                            <div class="col-md-12 col-lg-3 mb-3 mb-md-0">
                                                <a class="navbar-brand " href=""><img
                                                        src="{{ asset('images/k.webp') }}" alt=""
                                                        class="image-menu">
                                                </a>
                                            </div>
                                            <div class="col-md-12 col-lg-3">
                                                <a class="navbar-brand " href=""><img
                                                        src="{{ asset('images/t.jpg') }}" alt=""
                                                        class="image-menu"></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="/NewArivals">Exclusif</a>
                            </li>
                            {{-- contact --}}
                            <li class="nav-item">
                                <a class="nav-link" href="/contact">Contacter</a>
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
                                        <li><a class="dropdown-item" href="{{ route('logout') }}">Se déconnecter</a>
                                        </li>
                                        <li><a class="dropdown-item" href="/EditUser">Profile</a></li>
                                    @else
                                        <li><a class="dropdown-item" href="{{ route('login') }}">Se Connecter</a>
                                        </li>
                                    @endif



                                </ul>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link "
                                    href="/pannier"><span>{{ Cart::instance('shopping')->count() }}</span><i
                                        class="bi bi-cart"></i></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link "
                                    href="/wishlist"><span>{{ Cart::instance('wishlist')->count() }}</span><i
                                        class="bi bi-heart"></i></a>
                            </li>
                        </ul>

                    </div>
                </div>
            </nav>
        </nav>
    </header>

    @yield('content')


    <!-- Site footer -->
    <footer class="site-footer mb-0">
        <div class="container">
            <div class="row">
                <div class="col-sm-12 col-md-4">
                    <h6>NOUS CONTACTER</h6>
                    <p class="text-justify"> <a href="">1377 parc industriel SAPINO,
                            NOUACER,
                            Casablanca,</a></p>

                    <pre>
Du lundi au vendredi 10:00 - 18:00
Samedi et dimanche fermés.
Moroccan Tim
                        </pre>
                    <p>Téléphone : +212 713 700 446
                    </p>
                    {{-- <p>Courriel : <a href="mailto:info@classyandfabb.com"></a></p> --}}
                </div>

                <div class="col-xs-6 col-md-4">
                    <h6>CATEGORIES</h6>
                    <ul class="footer-links">
                        <li><a href="http://scanfcode.com/category/c-language/">Caftan</a></li>
                        <li><a href="http://scanfcode.com/category/front-end-development/">Takchita</a></li>
                        <li><a href="http://scanfcode.com/category/back-end-development/">Bijoux</a></li>
                        <li><a href="http://scanfcode.com/category/java-programming-language/">Boucles
                                D'oreilles</a>
                        </li>
                        <li><a href="http://scanfcode.com/category/android/">Colliers</a></li>

                    </ul>
                </div>

                <div class="col-xs-6 col-md-4">
                    <h6>NOUVELLES ET OFFRES</h6>
                    Rejoignez notre famille et soyez les premiers à être informés des lancements de produits, des
                    événements et de bien d'autres choses encore.
                    <li class=" list-unstyled "><a href="http://scanfcode.com/category/android/"
                            class="color">S'ABONNER</a></li>
                    <ul class="social-icons">
                        <li><a class="facebook" href="#"><i class="fa fa-facebook"></i></a></li>
                        <li><a class="twitter" href="#"> <i class="fa fa-twitter"></i></a></li>
                        <li><a class="dribbble" href="#"><i class="fa fa-dribbble"></i></a></li>
                        <li><a class="linkedin" href="#"><i class="fa fa-linkedin"></i></a></li>
                    </ul>
                </div>
            </div>
            <hr>
        </div>
        <div class="text-center mx-auto">





            <p class="copyright-text">Copyright &copy; 2022 Classy And Fabb. Tous droits réservés ❤❤❤❤❤
            </p>




        </div>

    </footer>


    <!-- JavaScript Bundle with Popper -->
    <script type="text/javascript" src="{{ asset('js/mdb.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous">
    </script>

    <script src="https://kit.fontawesome.com/552b1297ac.js" crossorigin="anonymous"></script>

</body>

</html>
