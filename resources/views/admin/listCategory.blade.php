@extends('admin.dashboard')
@section('form')
    <section class="col-9 mt-4" style="overflow-x: scroll">
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        <table class="table tab_le">
            <button class="btn btn-primary mb-5"> <a href="/add-category" class="text-white">Add Category</a></button>
            <thead class="table-dark">
                <th scope="col">#IdCategory</th>
                <th scope="col">libelCategory</th>
                <th scope="col">Image</th>
                <th scope="col" class="action">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($listCategory as $item)
                    <tr>
                        <td>{{ $item->id }}</td>
                        <td>{{ $item->libeleCateg }}</td>
                        <td> <img class="img-tab" src="/{{ $item->imageCategory }}"></td>


                        <td>

                            <button class="btn btn-primary"><a href="{{ route('editCateg', $item->id) }}"
                                    class="text-light"><i class="fa fa-pencil-square-o"
                                        aria-hidden="true"></i>Update</a></button>

                            <button class="btn btn-danger text-light" data-bs-toggle="modal"
                                data-bs-target="#confirm-modal"> <i class="fa-solid fa-trash-can"
                                    aria-hidden="true"></i>Delete</button>


                        </td>
                        <div class="modal" id="confirm-modal" tabindex="-1">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title text-danger fs-1">Delete</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <p class="fs-5">Voulez-vous Vraiment supprimer la catégorie?</p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Annuler</button>
                                        <button type="button" class="btn btn-primary"><a
                                                href="/delete-category/{{ $item->id }}"
                                                class="text-light">Oui</a></button>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </tr>
                @endforeach

            </tbody>
        </table>
        {{ $listCategory->links('pagination::bootstrap-4') }}

    </section>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.min.js"
        integrity="sha512-STof4xm1wgkfm7heWqFJVn58Hm3EtS31XFaagaa8VMReCXAkQnJZ+jEy8PCC/iT18dFy95WcExNHFTqLyp72eQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="{{ asset('js/app.js') }}"></script>
@endsection
