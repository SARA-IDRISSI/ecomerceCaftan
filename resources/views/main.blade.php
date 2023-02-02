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


</head>

<body>
    <header>
        <nav>
            <nav class="navbar navbar-expand-lg bg-body-tertiary shadow-sm">
                <div class="container img-header">
                    <a class="navbar-brand" href=""><img src="{{ asset('images/shoe-logo-new_300x300.avif') }}"
                            alt="" class="logo"></a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                        data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                        aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <div class="collapse navbar-collapse d-flex justify-content-end" id="navbarSupportedContent">
                        <form class="d-flex mx-auto " role="search">
                            <input class="form-control me-2 " type="search" placeholder="Search" aria-label="Search">
                            <button class="btn btn-outline-success" type="submit">Search</button>
                        </form>
                        <ul class="navbar-nav me-0 mb-2 mb-lg-0">
                            <li class="nav-item">
                                <a class="nav-link " aria-current="page" href="/">Home</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">A propos</a>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="" role="button"
                                    data-bs-toggle="dropdown" aria-expanded="false">
                                    Catégorie
                                </a>
                                <ul class="dropdown-menu">
                                    @foreach($categories as $category)
                                    <li><a class="dropdown-item" href="/category/{{ $category->id }}">{{ $category->libeleCateg }}</a></li>
                                    <ul class="">
                                        @foreach($category->subCategories as $subCategory)
                                        <li>{{ $subCategory->title }}</li>
                                        @endforeach
                                    </ul>
                                    @endforeach
                                </ul>
                            </li>

                            {{-- contact --}}
                            <li class="nav-item dropdown">
                                @if (Auth::check())
                                    <a class="nav-link dropdown-toggle" href="#" role="button"
                                        data-bs-toggle="dropdown" aria-expanded="false">

                                        <i class="bi bi-person-circle"></i>
                                        <span> Hi, {{ Auth::user()->username }} </span>
                                    </a>
                                @else
                                    <a class="nav-link dropdown-toggle" href="#" role="button"
                                        data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="bi bi-person-circle"></i>
                                    </a>
                                @endif
                                <ul class="dropdown-menu">
                                    @if (Auth::check())
                                    <li><a class="dropdown-item" href="{{ route('logout') }}">logOut</a></li>
                                    <li><a class="dropdown-item" href="#">Profile</a></li>

                                @else
                                <li><a class="dropdown-item" href="{{ route('login') }}">login</a></li>
                                @endif



                                </ul>
                            <li class="nav-item">
                                <a class="nav-link " aria-current="page" href="#"><i class="bi bi-cart3"></i></a>
                            </li>
                            </li>

                        </ul>

                    </div>
                </div>
            </nav>
        </nav>
    </header>

    @yield('content')
    <footer>


        <!-- JavaScript Bundle with Popper -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous">
        </script>

        <script src="https://kit.fontawesome.com/552b1297ac.js" crossorigin="anonymous"></script>
    </footer>
</body>

</html>
