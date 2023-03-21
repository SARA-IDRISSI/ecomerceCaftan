@extends('main')

@section('title', 'Connexion')

@section('content')
    <div class=" container row  mx-auto ">

        <div class="col-6
         mt-0 video">
            <video src="{{ asset('images/Video.mp4') }}" class="" autoplay muted></video>

        </div>
        <div class=" col-xs-12 col-md-6  mt-5 p-5">


            @if (session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif
            <form action='' method="post">
                @csrf
                <h1 class="color p1">Login</h1>
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Email address</label>
                    <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                        name="email">
                </div>
                <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">Password</label>
                    <input type="password" class="form-control" id="exampleInputPassword1" name="password">
                </div>
                <div class="d-grid gap-2">
                    <button type="submit" class="btn  text-white fs-3 colorSubmit hvr-sweep-to-rightt">Submit</button>
                </div>
                <div class="mt-3 d-flex justify-content-between">
                    <div class="col-6">
                        <a href="forgotPassword" class="color">Mot de passe Oublier</a>
                    </div>
                    <div class="col-1">
                        <a href="/register" class="color">S'inscrire</a>
                    </div>
                </div>

            </form>
        </div>
    </div>
@endsection
