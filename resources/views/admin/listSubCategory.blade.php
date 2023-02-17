@extends('admin.dashboard')
@section('form')
    <section class="col-9 mt-4" style="overflow-x: scroll">
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        <table class="table tab_le">
            <button class="btn btn-primary mb-5"> <a href="newSubCategory" class="text-white">Add Category</a></button>
            <thead class="table-dark">
                <th scope="col">#CategoryId</th>
                <th scope="col">title</th>
                <th scope="col" class="action">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($listSub
                Category as $item)
                    <tr>
                        <td>{{ $item->id }}</td>
                        <td>{{ $item->libeleCateg }}</td>


                        <td>

                            <button class="btn btn-primary"><a href="/edit/{{ $item->id }}" class="text-light"><i
                                        class="fa fa-pencil-square-o" aria-hidden="true"></i>Update</a></button>

                            <button class="btn btn-danger text-light" data-bs-toggle="modal"
                                data-bs-target="#confirm-modal"> <i class="fa-solid fa-trash-can"
                                    aria-hidden="true"></i>Delete</button>


                        </td>
                    </tr>
                @endforeach
                </tr>
                <div class="modal" id="confirm-modal" tabindex="-1">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Modal title</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <p>Modal body text goes here.</p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                                <button type="button" class="btn btn-primary"><a
                                        href="/delete-category/{{ $item->id }}" class="text-light">Oui</a></button>
                            </div>

                        </div>
                    </div>
                </div>

            </tbody>
        </table>

    </section>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.min.js"
        integrity="sha512-STof4xm1wgkfm7heWqFJVn58Hm3EtS31XFaagaa8VMReCXAkQnJZ+jEy8PCC/iT18dFy95WcExNHFTqLyp72eQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="{{ asset('js/app.js') }}"></script>
@endsection
