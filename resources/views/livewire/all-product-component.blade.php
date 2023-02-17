<div class="col-9" style="overflow-x: scroll">
    <button class="btn btn-primary my-5"> <a href="add-product" class="text-light">Add Article</a></button>

    <!-- table crud -->

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if ($successMessage)
        <div class="alert alert-success">{{ $successMessage }}</div>
    @endif
    <table class="table tab_le">
        <thead class="table-dark">
            <tr class="">
                <th scope="col" class="tt">#IdArticle</th>
                <th scope="col">Titre</th>
                <th scope="col">Catégorie</th>
                <th scope="col">Image</th>
                <th scope="col">CodeBar</th>
                <th scope="col">Description</th>
                <th scope="col">Date</th>
                <th scope="col">InStock</th>
                <th scope="col">Promo</th>
                <th scope="col">PrixPromo</th>
                <th scope="col">PrixActuel</th>
                <th scope="col">inventory Product</th>
                <th scope="col">inventory taille</th>
                <th scope="col">inventory color</th>
                <th scope="col" class="action">Actions</th>
            </tr>
        </thead>
        <div>
            @foreach ($articles as $article)
                <tr>
                    <td>{{ $article->id }}</td>
                    <td>{{ $article->title }}</td>
                    <td>{{ $article->category->libeleCateg }}</td>
                    <td> <img class="img-tab" src="/{{ $article->photo }}"> </td>
                    <td>{{ $article->barcode }}</td>
                    <td>{{ $article->description }}</td>
                    <td>{{ $article->updated_at }}</td>
                    <td>{{ $article->instock }}</td>
                    <td>{{ $article->promo ? 'Yes' : 'No' }}</td>
                    <td>{{ $article->prix_promotion }}</td>
                    <td>{{ $article->prix_actuel }}</td>
                    <td>
                        @foreach ($article->productSizes as $item)
                            <p>{{ $item->stock }}</p>
                        @endforeach
                    </td>
                    <td>
                        @foreach ($article->productSizes as $item)
                            <p>{{ $item->size }}</p>
                        @endforeach
                    </td>
                    <td>
                        @foreach ($article->productSizes as $item)
                            <strong>{{ $item->size }} </strong>
                            @foreach ($item->colors as $color => $stock)
                                <div>
                                    <input type="color" value="{{ $color }}" disabled />
                                    <span>{{ $stock }}</span>
                                </div>
                            @endforeach
                        @endforeach
                    </td>
                    <td>
                        <button class="btn btn-info"><a href="/detailProduct/{{ $article->id }}" class="text-light"><i
                                    class="fa fa-eye" aria-hidden="true"></i>
                                show</a></button>
                        <button class="btn btn-primary"><a href="/edit/{{ $article->id }}" class="text-light">
                                <i class="fa fa-pencil-square-o" aria-hidden="true"></i>Update</a></button>

                        <button class="btn btn-danger text-light" data-bs-toggle="modal"
                            data-bs-target="#confirm-modal"> <i class="fa-solid fa-trash-can"
                                aria-hidden="true"></i>Delete</button>
                    </td>
                    <div class="modal" id="confirm-modal" tabindex="-1">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Modal title</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <p>Modal body text goes here</p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Annuler</button>
                                    <button data-bs-dismiss="modal" wire:click="delete({{ $article->id }})"
                                        class="btn btn-primary">
                                        Oui</button>
                                </div>
                                {{-- <a href="/delete/{{ $article->id }}"
                                                class="text-light">Oui</a> --}}
                            </div>
                        </div>
                    </div>
                </tr>
            @endforeach
        </div>
    </table>
</div>
