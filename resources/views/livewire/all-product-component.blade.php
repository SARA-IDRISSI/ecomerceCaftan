<div class="col-9">
    <div class="row container mb-3">
        <h1 class="text-black mb-4 mt-3  titleDashboard">Toute Les Articles</h1>

        {{-- <div class=" d-flex justify-content-between"> --}}
        <div class=" col-12 my-3">
            <button class="btn colo"> <a href="add-product" class="text-light">Ajouter
                    Article</a></button>
        </div>
        <div class="col-4 my-3 ">
            <input type="search" placeholder="filtrer par Nom" wire:keydown='handleChange($event.target.value)'
                class="form-control  w-75 " />
        </div>
        <div class="col-4 my-3 ">
            <select type="search" placeholder="filtrer par Promo" wire:change='handleChangePromo($event.target.value)'
                class="form-control  w-75 ">
                <option></option>
                <option @if ($promo == 1) selected @endif value="1">Yes</option>
                <option @if ($promo == 0) selected @endif value="0">No</option>
            </select>
        </div>

        <div class="col-4 my-3 ">
            <input type="date" wire:model='date' value="{{ Carbon\Carbon::parse($date)->format('Y-m-d') }}"
                placeholder="filtrer par date" wire:change='handleChangeDate($event.target.value)'
                class="form-control  w-75 " />
        </div>
        {{-- </div> --}}
        <!-- table crud -->
    </div>
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if ($successMessage)
        <div class="alert alert-success">{{ $successMessage }}</div>
    @endif
    <div class="col-12" style="overflow-x: scroll;">
        <table class="table">
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
                    <th scope="col">Qty Bijoux</th>
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
                        <td>{{ substr($article->description, 0, 30) }}...</td>
                        <td>{{ $article->updated_at }}</td>
                        <td>{{ $article->instock }}</td>
                        <td>{{ $article->promo ? 'Yes' : 'No' }}</td>
                        <td>{{ $article->prix_promotion }}</td>
                        <td>{{ $article->prix_actuel }}</td>
                        <td>{{ $article->qtyB }}</td>
                        <td>
                            @foreach ($article->productSizes as $item)
                                <p class="mb-4">{{ $item->stock }}</p>
                            @endforeach
                        </td>
                        <td>
                            @foreach ($article->productSizes as $item)
                                <p class="mb-4">{{ $item->size }}</p>
                            @endforeach
                        </td>
                        <td>
                            @foreach ($article->productSizes as $item)
                                {{-- <strong>{{ $item->size }} </strong> --}}
                                @foreach ($item->colors as $color => $stock)
                                    <div class="mb-3">
                                        <input type="color" value="{{ $color }}" disabled />
                                        {{-- <span>{{ $stock }}</span> --}}
                                    </div>
                                @endforeach
                            @endforeach
                        </td>
                        <td>
                            <button class="btn btn-info"><a href="/detailProduct/{{ $article->id }}"
                                    class="text-light"><i class="bi bi-eye" aria-hidden="true"></i>
                                    Afficher</a></button>
                            <button class="btn btn-primary"><a href="/edit/{{ $article->id }}" class="text-light">
                                    <i class="bi bi-pen"></i> Modifier</a></button>

                            <button class="btn btn-danger text-light" data-bs-toggle="modal"
                                data-bs-target="#confirm-modal"> <i class="bi bi-trash3"></i> Supprimer</button>
                        </td>
                        <div class="modal" id="confirm-modal" tabindex="-1">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title text-danger">Supprimer Produit</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <p>Voulez Vous Vraiment supprimer le produit ?</p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Annuler</button>
                                        <button data-bs-dismiss="modal" wire:click="delete({{ $article->id }})"
                                            class="btn btn-danger">
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
        {{ $articles->links() }}
    </div>
</div>
