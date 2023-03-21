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
        <form class="col-10" action="" method="POST" enctype="multipart/form-data">
            @csrf
            <h1 class="titleDashboard w-100 mt-3 mb-5 ">AJOUTER UN CATEGORIE </h1>

            <div class="col-6">
                <label for="" class="form-label mb-3
                ">le nom de catégorie</label>
                <input type="text" name="title" id="" class="form-control">

            </div>
            <div class="col-6">
                <label for="" class="form-label mt-3
                ">Ajouter Image</label>
                <input type="file" name="image" id="file" class="form-control" accept="image/*"
                    onchange="previewImage();">
                <img id="preview" alt="Image Category" class="w-50 h-50">


            </div>
            <button type="submit" class="btn colo mt-3">Ajouter</button>
        </form>
    </main>
    <script>
        let preview = document.getElementById("preview");
        preview.style.display = "none";

        function previewImage() {
            let file = document.getElementById("file").files;
            if (file.length > 0) {
                let fileReader = new FileReader();
                fileReader.onload = function(event) {
                    preview.style.display = "block";
                    preview.setAttribute("src", event.target.result);
                };
                fileReader.readAsDataURL(file[0]);
            }

        }
    </script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.min.js"
        integrity="sha512-STof4xm1wgkfm7heWqFJVn58Hm3EtS31XFaagaa8VMReCXAkQnJZ+jEy8PCC/iT18dFy95WcExNHFTqLyp72eQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="{{ asset('js/app.js') }}"></script>
@endsection
