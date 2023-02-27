@extends('admin.dashboard')
@section('title', 'admin')
@section('form')



    <main class="col-8">
        {{-- add categorie --}}
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif
        <form class="col-10" action="" method="POST">
            @csrf
            <h1 class="text-black mb-5 mt-3 titleDashboard">AJOUTER UN SUB-CATEGORIE</h1>


            <div class="col-6">
                <label for="" class="form-label">le nom de Subcatégorie</label>
                <input type="text" name="title" id="" class="form-control">
                <label for="" class="form-label">dans lequel</label>
                <select name="category_id" class="form-select" aria-label="Default select example">
                    <option value="{{ $categories[0]->id }}">{{ $categories[0]->libeleCateg }}</option>
                    @for ($i = 1; $i < count($categories); $i++)
                        <option value="{{ $categories[$i]->id }}">{{ $categories[$i]->libeleCateg }}</option>
                    @endfor
                </select>
            </div>
            <button type="submit" class="btn btn-primary mt-3">Add</button>
        </form>
    </main>
@endsection
