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
                                                        <a class=""
                                                            href="/category/{{ $category->id }}">{{ $category->libeleCateg }}
                                                            @if (count($category->subCategories) > 0)
                                                                &raquo;
                                                            @endif
                                                        </a>
                                                    </div>
                                                    @if (count($category->subCategories) > 0)
                                                        <ul class="">
                                                            @foreach ($category->subCategories as $subCategory)
                                                                <li>
                                                                    <a class="dropdown-item boutique-title"
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

    {{ $slot }}
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
