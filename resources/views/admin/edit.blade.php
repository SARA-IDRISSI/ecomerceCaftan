@extends('admin.dashboard')
@section('form')
    @livewireStyles
    <div class="col-1"></div>


    <div class="col-9 row addProd shadow-5-soft mt-3 pt-5 ps-5">
        <h1 class="text-black mb-5  titleDashboard">Modifier Article</h1>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif
        <form action="/edit/{{ $article->id }}" method="post" class="row" enctype="multipart/form-data">
            @csrf
            <div class="col-4">
                <label for="" class="form-label">Title</label>
                <input value="{{ $article->title }}" type="text" name="title" id="" class="form-control">
            </div>
            <div class="col-4">
                <label for="" class="form-label">Ajouter image</label>
                <input type="file" name="image" id="file" class="form-control" accept="image/*"
                    onchange="previewImage();" /> <img src="/{{ $article->photo }}" id="preview" class="w-50" />
            </div>
            <div class="col-4">
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
            <p for="" class="mt-5 fs-2"> <i class="bi bi-check2"></i> Section Caftan / Takchita</p>
            <div class="row g-3 border pb-5">

                <div class="row g-3">

                    <div class="row g-3">
                        @foreach ($article->productSizes as $size)
                            <div class="col-4">
                                <div class="">
                                    <label for="inputState" class="form-label col-12  NomTaille">Taille
                                        {{ $size->size }}</label>

                                    <button onclick="addColor(event, '{{ strtolower($size->size) }}')"
                                        class="addcolor inputStock">Ajouter
                                        Couleur/Qty</button>
                                    @foreach ($size->colors as $color => $stock)
                                        <div class="colors colors-{{ strtolower($size->size) }} d-flex col-12 flex-wrap">
                                            <input type="hidden" value="1"
                                                id="last-index-{{ strtolower($size->size) }}" />
                                            <input type="hidden" value="1"
                                                name="colors_indexes_{{ strtolower($size->size) }}"
                                                id="indexes-{{ strtolower($size->size) }}" />
                                            <div class="col-2 mt-3 inputs_1_{{ strtolower($size->size) }}">
                                                <input name="color_1_{{ strtolower($size->size) }}" type="color"
                                                    class="form-control form-control-color inputStock"
                                                    id="exampleColorInput" value="{{ $color }}"
                                                    title="Choose your color">

                                                <input required name="stock_1_{{ strtolower($size->size) }}" type="number"
                                                    class="form-control my-3 my-3  form-control-color inputStock"
                                                    id="stock" value="{{ $stock }}">
                                                <button onclick="removeColor(event, 1, '{{ strtolower($size->size) }}')"
                                                    class="btn btn-danger btn-small inputStock"
                                                    id="btn-color-1-{{ strtolower($size->size) }}">x</button>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endforeach
                        @foreach ($sizes as $size)
                            <div class="col-md-4">
                                <label for="inputState" class="form-label col-12 NomTaille">Taille
                                    {{ $size }}</label>
                                {{-- <input type="text" name="" id="" value="{{ $size }}" disabled> --}}
                                {{-- <label for="exampleColorInput" class="form-label">Couleur</label> --}}
                                <button onclick="addColor(event, '{{ strtolower($size) }}')"
                                    class="addcolor inputStock col-4">Ajouter Couleur/Qty</button>
                                <div class="colors-{{ strtolower($size) }} d-flex flex-wrap">
                                    <input type="hidden" value="" id="last-index-{{ strtolower($size) }}" />
                                    <input type="hidden" value="" name="colors_indexes_{{ strtolower($size) }}"
                                        id="indexes-{{ strtolower($size) }}" />
                                    {{-- <div class="col-12 mt-3 inputs_1_{{ strtolower($size) }}">
                                        <input name="color_1_{{ strtolower($size) }}" type="color"
                                            class="form-control form-control-color" id="exampleColorInput"
                                            value="#563d7c" title="Choose your color">
                                        <input required name="stock_1_{{ strtolower($size) }}" type="number"
                                            class="form-control form-control-color inputStock my-3" id="stock">
                                        <button onclick="removeColor(event, 1, '{{ strtolower($size) }}')"
                                            class="btn btn-danger inputStock btn-small"
                                            id="btn-color-1-{{ strtolower($size) }}">x</button>
                                    </div> --}}
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <p for="" class="mt-5 fs-2"> <i class="bi bi-check2"></i> Section Bijoux</p>
            <div div class="row g-3 border pb-3 ">
                <label for="" class="NomTaille">Qantity bijoux</label>
                <input type="number" id="typeNumber" name="qtyB" value="{{ $article->qtyB }}"
                    class="form-control ms-2 w-25 py-3" placeholder="Qty" />

            </div>

            <button id="add-image" class="my-5 addcolor"> Ajouter Toutes Les Images de Article </button>


            <div class="images-container mx-auto container row my-3 p-4 ">
                <input type="hidden" name="last_index_images" value="{{ count($article->imageProducts) }}"
                    id="last-index-image" />
                <input type="hidden" name="colors_indexes_images"
                    value="{{ implode('', array_map(fn($value) => $value + 1, array_keys($article->imageProducts->toArray()))) }}"
                    id="indexes-images" />
                @foreach ($article->imageProducts as $key => $image)
                    <div class="row col-5 " id="image-container-{{ $key + 1 }}">
                        <div class="gy-2">
                            <input type="hidden" value="{{ $image->id }}" name="image_id_{{ $key + 1 }}" />
                            <input oninput="handleImageChange(event, {{ $key + 1 }})" type="file"
                                name="image_{{ $key + 1 }}" id="image-file-{{ $key + 1 }}"
                                class="form-control form-control-file" />
                            <img src="/{{ $image->image }}" class="img-fluid w-100 h-75" />
                            <input required type="color" name="image_color_{{ $key + 1 }}"
                                class="form-control form-control-color" value="{{ $image->color }}" />
                            <button onclick="removeImage(event, {{ $key + 1 }})"
                                class="btn btn-danger btn-small mb-3">x</button>
                        </div>
                    </div>
                @endforeach
            </div>




            <div class="col-6">
                <label for="" class="form-label my-3">Quel Catégorie</label>
                <select id="categories" class="form-select col-4" aria-label="Default select example"
                    name="category_id">
                    @for ($i = 0; $i < count($categories); $i++)
                        @if ($categories[$i]->id == $article->category->id)
                            <option selected value="{{ $article->category->id }}">
                                {{ $article->category->libeleCateg }}
                            </option>
                        @else
                            <option value="{{ $categories[$i]->id }}">{{ $categories[$i]->libeleCateg }}</option>
                        @endif
                    @endfor
                </select>
            </div>

            <div class="col-6">
                <label for="" class="form-label mt-4">Quel SubCatégorie</label>
                @foreach ($categories as $category)
                    <select id="category-{{ $category->id }}"
                        class="category form-select col-4 mb-1  {{ $category->id == $article->category->id ? 'd-block' : 'd-none' }}"
                        aria-label="Default select example" name="sub_category_id">
                        @foreach ($category->subCategories as $subCategory)
                            <option value="{{ $subCategory->id }}">{{ $subCategory->title }}</option>
                        @endforeach
                    </select>
                @endforeach
            </div>
            <button type="submit" class="btn colo my-4">Modifier Produit</button>

        </form>

    </div>

    @livewireScripts
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.min.js"
        integrity="sha512-STof4xm1wgkfm7heWqFJVn58Hm3EtS31XFaagaa8VMReCXAkQnJZ+jEy8PCC/iT18dFy95WcExNHFTqLyp72eQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="{{ asset('js/app-edit.js') }}"></script>
@endsection
