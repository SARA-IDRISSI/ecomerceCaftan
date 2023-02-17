@extends('main')

@section('title', 'Connexion')

@section('content')
    <div class="container col-6 mx-auto mt-5">
        @if (session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif
        <form action='' method="post">
            @csrf
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Email address</label>
                <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="email">
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Password</label>
                <input type="password" class="form-control" id="exampleInputPassword1" name="password">
            </div>
            <div class="d-grid gap-2">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
            <div class="mt-3 d-flex justify-content-between">
                <div class="col-6">
                    <a href="forgotPassword">Mot de passe Oublier</a>
                </div>
                <div class="col-1">
                    <a href="/register">S'inscrire</a>
                </div>
            </div>

        </form>
    </div>
@endsection
