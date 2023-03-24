@extends('main')

@section('title', 'Connexion')

@section('content')
    <div class="container col-8 mx-auto">

        @if (session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif
        <h1 class="color p1 text-center my-5">
            Register
        </h1>
        <form action="" method="post" class="row g-3" enctype="multipart/form-data">
            @csrf
            <div class="col-md-6">
                <label for="inputEmail4" class="form-label">Nom</label>
                <input type="text" name="username" class="form-control" id="inputEmail4">
            </div>
            <div class="col-md-6">
                <label for="inputEmail4" class="form-label">Email</label>
                <input type="email" name="email" class="form-control" id="inputEmail4">
            </div>
            <div class="col-md-6">
                <label for="inputPassword4" class="form-label">Mot De Passe</label>
                <input type="password" name="password" class="form-control" id="inputPassword4">
            </div>
            <div class="col-12">
                <label for="formFile" class="form-label">Image(Optionnel)</label>
                <input class="form-control" type="file" name="image" id="formFile">
            </div>
            <div class="col-12 mt-5 mb-4">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="gridCheck" name="newsletter">
                    <label class="form-check-label" for="gridCheck">
                        Envoyez-moi les nouvelles et les
                        offres par e-mail
                    </label>
                </div>
            </div>
            <div class="d-grid gap-2">
                <button type="submit" class="btn text-white fs-3 colo hvr-sweep-to-rightt">Sign Up</button>
            </div>

        </form>
    </div>
@endsection
