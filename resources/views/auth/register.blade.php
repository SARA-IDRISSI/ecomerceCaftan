@extends('main')

@section('title', 'Connexion')

@section('content')
    <div class="container col-8 mx-auto">
        @if (session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif
        <form action="" method="post" class="row g-3" enctype="multipart/form-data">
            @csrf
            <div class="col-md-6">
                <label for="inputEmail4" class="form-label">Username</label>
                <input type="text" name="username" class="form-control" id="inputEmail4">
            </div>
            <div class="col-md-6">
                <label for="inputEmail4" class="form-label">Email</label>
                <input type="email" name="email" class="form-control" id="inputEmail4">
            </div>
            <div class="col-md-6">
                <label for="inputPassword4" class="form-label">Password</label>
                <input type="password" name="password" class="form-control" id="inputPassword4">
            </div>
            <div class="col-12">
                <label for="formFile" class="form-label">Image</label>
                <input class="form-control" type="file" name="image" id="formFile">
            </div>
            <div class="d-grid gap-2">
                <button type="submit" class="btn btn-primary">Sign Up</button>
            </div>
        </form>
    </div>
@endsection
