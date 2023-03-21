@extends('main')

@section('title', 'Connexion')

@section('content')
    <div class="container col-6 mx-auto mt-5">
        <form action='{{ route('sendEmail') }}' method="post">
            @csrf
            <div class="mb-3">
                <h1 class="color p1">Réinitialiser votre mot de passe</h1>
                <p class="alert alert-secondary">Forgot your password ? No problem.just write your email adress and we will
                    email
                    you a password reset link that will allow you to choose a new one. </p>
                @if (session('error'))
                    <div class="alert alert-danger">{{ session('error') }}</div>
                @endif
                @if (session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif
                <label for="exampleInputEmail1" class="form-label">Email address</label>
                <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                    name="email" required>
            </div>

            <div class="d-grid gap-2">
                <button type="submit" class="btn colo">Confirmer</button>
            </div>

    </div>

    </form>
    </div>
@endsection
