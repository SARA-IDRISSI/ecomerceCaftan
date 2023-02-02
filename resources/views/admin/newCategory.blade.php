@extends('main')
@section('title','admin')
@section('content')

<main>
 {{-- add categorie --}}
 @if(session('success'))
 <div class="alert alert-success">{{ session('success') }}</div>
@endif
@if(session('error'))
 <div class="alert alert-danger">{{ session('error') }}</div>
@endif
 <form class="col-6" action="" method="POST">
    @csrf
 <h1>POUR AJOUTER UN CATEGORIE DANS LE NAV BAR</h1>

 <div>
     <label for="" class="form-label">le nom de catégorie</label>
     <input type="text" name="title" id="" class="form-control">

  </div>
  <button type="submit" class="btn btn-primary">Add</button>
</form>
</main>
@endsection
