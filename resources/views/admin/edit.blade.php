<script>
    function previewImage() {
        let file = document.getElementById("file").files;
        if (file.length > 0) {
            let fileReader = new FileReader();
            fileReader.onload = function(event) {
                document.getElementById("preview").setAttribute("src", event.target.result);
            };
            fileReader.readAsDataURL(file[0]);
        }

    }
</script>
@extends('admin.dashboard')
@section('form')
    @livewireStyles
    <div class="col-1"></div>
    <div class="col-6 addProd">
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif
        <form action="/edit/{{ $article->id }}" method="post" class="" enctype="multipart/form-data">
            @csrf
            <div>
                <label for="" class="form-label">Title</label>
                <input value="{{ $article->title }}" type="text" name="title" id="" class="form-control">
            </div>
            <div>
                <label for="" class="form-label">add image</label>
                <div> <img id="preview" alt="Article" class="w-50 h-50"></div>
                <input type="file" name="image" id="file" class="form-control" accept="image/*"
                    onchange="previewImage();">
                <img src="/{{ $article->photo }}" />
            </div>
            <div>
                <label for="" class="form-label">code bar</label>
                <input value="{{ $article->barcode }}" type="text" name="codebar" id="" class="form-control">
            </div>
            <div>
                <label for="" class="form-label">Description</label>
                <textarea name="description" id="" cols="30" rows="5" class="form-control">{{ $article->description }}</textarea>
            </div>
            <livewire:price-component :promo="$article->promo" :prix_actuel="$article->prix_actuel" :prix_promotion="$article->prix_promotion" />
            <div class="sizes">
                <input id="count-size" type="hidden" value="{{ count($article->productSizes) }}" name="size_count" />
            </div>

            {{-- tailles --}}
            <hr>
            @foreach ($article->productSizes as $size)
                <div class="row g-3">
                    <div class="col-md-4">
                        <label for="inputState" class="form-label">Taille {{ $size->size }}</label>
                        <input type="text" name="" id="" value="{{ $size->size }}" disabled>
                        <label for="exampleColorInput" class="form-label">Couleur</label>
                        <button onclick="addColor(event, '{{ strtolower($size->size) }}')">Add color</button>
                        @foreach ($size->colors as $color => $stock)
                            <div class="colors-{{ strtolower($size->size) }} d-flex">
                                <input type="hidden" value="1" id="last-index-{{ strtolower($size->size) }}" />
                                <input type="hidden" value="1" name="colors_indexes_{{ strtolower($size->size) }}"
                                    id="indexes-{{ strtolower($size->size) }}" />
                                <div class="col-12 inputs_1_{{ strtolower($size->size) }}">
                                    <input name="color_1_{{ strtolower($size->size) }}" type="color"
                                        class="form-control form-control-color" id="exampleColorInput"
                                        value="{{ $color }}" title="Choose your color">

                                    <input required name="stock_1_{{ strtolower($size->size) }}" type="number"
                                        class="form-control form-control-color" id="stock" value="{{ $stock }}">
                                    <button onclick="removeColor(event, 1, '{{ strtolower($size->size) }}')"
                                        class="btn btn-primary btn-small"
                                        id="btn-color-1-{{ strtolower($size->size) }}">x</button>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endforeach
            @foreach ($sizes as $size)
                <div class="row g-3">
                    <div class="col-md-4">
                        <label for="inputState" class="form-label">Taille {{ $size }}</label>
                        <input type="text" name="" id="" value="{{ $size }}" disabled>
                        <label for="exampleColorInput" class="form-label">Couleur</label>
                        <button onclick="addColor(event, '{{ strtolower($size) }}')">Add color</button>
                        <div class="colors-{{ strtolower($size) }} d-flex">
                            <input type="hidden" value="1" id="last-index-{{ strtolower($size) }}" />
                            <input type="hidden" value="1" name="colors_indexes_{{ strtolower($size) }}"
                                id="indexes-{{ strtolower($size) }}" />
                            <div class="col-12 inputs_1_{{ strtolower($size) }}">
                                <input name="color_1_{{ strtolower($size) }}" type="color"
                                    class="form-control form-control-color" id="exampleColorInput" value="#563d7c"
                                    title="Choose your color">
                                <input required name="stock_1_{{ strtolower($size) }}" type="number"
                                    class="form-control form-control-color" id="stock">
                                <button onclick="removeColor(event, 1, '{{ strtolower($size) }}')"
                                    class="btn btn-primary btn-small" id="btn-color-1-{{ strtolower($size) }}">x</button>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
            <hr>
            {{-- <div class="col-md-6">
        <label for="exampleColorInput" class="form-label">Couleur</label>
        <input name="color-${i}" type="color" class="form-control form-control-color" id="exampleColorInput" value="#563d7c" title="Choose your color">
    </div>
    <div class="col-md-6">
      <label for="stock" class="form-label">Stock</label>
      <input name="stock_${i}" type="number" class="form-control form-control-color" id="stock">
    </div> --}}
            <div class="images-container">
                <input type="hidden" name="last_index_images" value="{{ count($article->productImages) }}"
                    id="last-index-image" />
                <input type="hidden" name="colors_indexes_images"
                    value="{{ implode('', array_map(fn($value) => $value + 1, array_keys($article->productImages->toArray()))) }}"
                    id="indexes-images" />
                @foreach ($article->productImages as $key => $image)
                    <div class="row col-4" id="image-container-{{ $key + 1 }}">
                        <input type="hidden" value="{{ $image->id }}" name="image_id_{{ $key + 1 }}" />
                        <input oninput="handleImageChange(event, {{ $key + 1 }})" type="file"
                            name="image_{{ $key + 1 }}" id="image-file-{{ $key + 1 }}"
                            class="form-control form-control-file" />
                        <img src="/{{ $image->image }}" class="img-fluid" />
                        <input required type="color" name="image_color_{{ $key + 1 }}"
                            class="form-control form-control-color" value="{{ $image->color }}" />
                        <button onclick="removeImage(event, {{ $key + 1 }})"
                            class="btn btn-primary btn-small">x</button>
                    </div>
                @endforeach
            </div>
            <button id="add-image"> add image </button>

            <div>
                <label for="" class="form-label">Ajouter Catégorie</label>
                <select id="categories" class="form-select" aria-label="Default select example" name="category_id">
                    @for ($i = 0; $i < count($categories); $i++)
                        @if ($categories[$i]->id == $article->category->id)
                            <option selected value="{{ $article->category->id }}">{{ $article->category->libeleCateg }}
                            </option>
                        @else
                            <option value="{{ $categories[$i]->id }}">{{ $categories[$i]->libeleCateg }}</option>
                        @endif
                    @endfor
                </select>
            </div>

            <div>
                <label for="" class="form-label">Ajouter SubCatégorie</label>
                @foreach ($categories as $category)
                    <select id="category-{{ $category->id }}"
                        class="category form-select {{ $category->id == $article->category->id ? 'd-block' : 'd-none' }}"
                        aria-label="Default select example" name="sub_category_id">
                        @foreach ($category->subCategories as $subCategory)
                            <option value="{{ $subCategory->id }}">{{ $subCategory->title }}</option>
                        @endforeach
                    </select>
                @endforeach
            </div>
            <button type="submit" class="btn btn-primary">Add Product</button>
        </form>


        {{-- add categorie --}}

    </div>
    </div>
    </main>
    @livewireScripts
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.min.js"
        integrity="sha512-STof4xm1wgkfm7heWqFJVn58Hm3EtS31XFaagaa8VMReCXAkQnJZ+jEy8PCC/iT18dFy95WcExNHFTqLyp72eQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="{{ asset('js/app-edit.js') }}"></script>
@endsection
