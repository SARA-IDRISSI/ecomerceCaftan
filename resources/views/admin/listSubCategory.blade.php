@extends('admin.dashboard')
@section('form')
    <section class="col-9 mt-4" style="overflow-x: scroll">
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        <table class="table ">
            <h1 class="titleDashboard w-100  mb-5 ">Toutes les Catégories </h1>

            <button class="btn colo mb-5"> <a href="add-subcategory" class="text-white">Ajouter SubCategories</a></button>
            <thead class="table-dark">
                <th scope="col">#SubCategoryId</th>
                <th scope="col">title</th>
                <th scope="col" class="action">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($listSubCategory as $item)
                    <tr>
                        <td>{{ $item->id }}</td>
                        <td>{{ $item->title }}</td>


                        <td>

                            <button class="btn btn-primary"><a href="{{ route('editSubCateg', $item->id) }}"
                                    class="text-light"><i class="bi bi-pen"></i> Modifier</a></button>

                            <button class="btn btn-danger text-light" data-bs-toggle="modal"
                                data-bs-target="#confirm-modal"> <i class="bi bi-trash3"></i> Supprimer</button>


                        </td>
                    </tr>
                    <div class="modal" id="confirm-modal" tabindex="-1">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title fs-1 text-danger">Supprimer</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <p class="fs-5">Voulez-vous Vraiment supprimer SubCategorie?.</p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Annuler</button>
                                    <button type="button" class="btn btn-primary"><a
                                            href="/delete-sub-category/{{ $item->id }}"
                                            class="text-light">Oui</a></button>
                                </div>

                            </div>
                        </div>
                    </div>
                @endforeach
            </tbody>
        </table>

    </section>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.min.js"
        integrity="sha512-STof4xm1wgkfm7heWqFJVn58Hm3EtS31XFaagaa8VMReCXAkQnJZ+jEy8PCC/iT18dFy95WcExNHFTqLyp72eQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="{{ asset('js/app.js') }}"></script>
@endsection
