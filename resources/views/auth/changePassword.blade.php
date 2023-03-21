@extends('main')

@section('title', 'Connexion')

@section('content')
    <div class="container col-6 mx-auto mt-5">
        <h1 class="color p1 text-center my-5">
            Change Password
        </h1>
        <form action='' method="post">
            @csrf
            @if (session('error'))
                <div class="alert alert-danger"> {{ session('error') }}</div>
            @endif
            @if (session('success'))
                <div class="alert alert-success"> {{ session('success') }}</div>
                <a href="/login">Se connecter</a>
            @endif

            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Email address</label>
                <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                    name="email">
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Password</label>
                <input type="password" class="form-control" id="exampleInputPassword1" name="password">
            </div>
            <div class="mb-3">

                <label for="exampleInputPassword1" class="form-label">Confirm Your Password</label>
                <input type="password" name="confirm" class="form-control" id="exampleInputPassword1">
            </div>
            <div class="d-grid gap-2">
                <button type="submit" class="btn colo">reset</button>
            </div>



    </div>

    </form>
    </div>
@endsection
