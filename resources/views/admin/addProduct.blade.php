@extends('admin.dashboard')
@section('form')
    @livewireStyles
    <div class="col-1"></div>

    <div class="col-9 addProd shadow-5-soft mt-3 pt-5 ps-5">

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif
        <form action="{{ route('post-product') }}" method="post" class="row" enctype="multipart/form-data">
            @csrf
            <div class="col-4">
                <label for="" class="form-label">Title</label>
                <input type="text" name="title" id="" class="form-control">
            </div>
            <div class="col-4">
                <label for="" class="form-label">add image</label>
                <input type="file" name="image" id="file" class="form-control" accept="image/*"
                    onchange="previewImage();">
                <img id="preview" alt="Article" class="w-50 h-50">
            </div>
            <div class="col-4">
                <label for="" class="form-label">code bar</label>
                <input type="text" name="codebar" id="" class="form-control">
            </div>
            <div>
                <label for="" class="form-label">Description</label>
                <textarea name="description" id="" cols="30" rows="5" class="form-control"></textarea>
            </div>
            <livewire:price-component />
            <div class="sizes">
                <input id="count-size" type="hidden" value="0" name="size_count" />
            </div>
            {{-- tailles --}}

            <div class="row g-3">
                <div class="col-md-4">
                    <label for="inputState" class="form-label col-12 col-12  NomTaille">Taille XS</label>
                    <button onclick="addColor(event, 'xs')" class="col-4 addcolor inputStock">Add color</button>
                    <div class="colors-xs d-flex col-12 flex-wrap">
                        <input type="hidden" value="1" id="last-index-xs" />
                        <input type="hidden" value="1" name="colors_indexes_xs" id="indexes-xs" />
                        <div class="col-2 mt-3 inputs_1_xs">
                            <input name="color_1_xs" type="color" class=" inputStock form-control form-control-color"
                                id="exampleColorInput" value="#563d7c" title="Choose your color">
                            <input required name="stock_1_xs" type="number"
                                class="form-control my-3 my-3  form-control-color inputStock" id="stock">
                            <button onclick="removeColor(event, 1, 'xs')" class="btn btn-danger inputStock btn-small"
                                id="btn-color-1-xs">x</button>
                        </div>

                    </div>
                </div>
                <div class="col-md-4">
                    <label for="inputState" class="form-label col-12 col-12  NomTaille">Taille S</label>
                    <button onclick="addColor(event, 's')" class="addcolor inputStock col-4">Add color</button>
                    <div class="colors-s d-flex col-12 flex-wrap">
                        <input type="hidden" value="1" id="last-index-s" />
                        <input type="hidden" value="1" name="colors_indexes_s" id="indexes-s" />
                        <div class="col-2 mt-3 inputs_1_s">
                            <input name="color_1_s" type="color" class=" inputStock form-control form-control-color"
                                id="exampleColorInput" value="#563d7c" title="Choose your color">

                            <input required name="stock_1_s" type="number"
                                class="form-control inputStock my-3 form-control-color" id="stock">
                            <button onclick="removeColor(event, 1, 's')" class="btn btn-danger inputStock btn-small"
                                id="btn-color-1-s">x</button>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <label for="inputState" class="form-label col-12  NomTaille">Taille M</label>
                    <button onclick="addColor(event, 'm')" class="addcolor inputStock col-4">Add color</button>
                    <div class="colors-m d-flex">
                        <input type="hidden" value="1" id="last-index-m" />
                        <input type="hidden" value="1" name="colors_indexes_m" id="indexes-m" />
                        <div class="col-12 mt-3 inputs_1_m">
                            <input name="color_1_m" type="color" class=" inputStock form-control form-control-color"
                                id="exampleColorInput" value="#563d7c" title="Choose your color">
                            <input required name="stock_1_m" type="number"
                                class="form-control inputStock my-3 form-control-color" id="stock">
                            <button onclick="removeColor(event, 1, 'm')" class="btn btn-danger inputStock btn-small"
                                id="btn-color-1-m">x</button>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <label for="inputState" class="form-label col-12  NomTaille">Taille L</label>

                    <button onclick="addColor(event, 'l')" class="addcolor inputStock col-4">Add color</button>
                    <div class="colors-l d-flex">
                        <input type="hidden" value="1" id="last-index-l" />
                        <input type="hidden" value="1" name="colors_indexes_l" id="indexes-l" />
                        <div class="col-12 mt-3 inputs_1_l">
                            <input name="color_1_l" type="color" class=" inputStock form-control form-control-color"
                                id="exampleColorInput" value="#563d7c" title="Choose your color">
                            <input required name="stock_1_l" type="number"
                                class="form-control my-3 inputStock form-control-color" id="stock">
                            <button onclick="removeColor(event, 1, 'l')" class="btn btn-danger inputStock btn-small"
                                id="btn-color-1-l">x</button>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <label for="inputState" class="form-label col-12  NomTaille">Taille XL</label>

                    <button onclick="addColor(event, 'xl')" class="addcolor inputStock col-4">Add color</button>
                    <div class="colors-xl d-flex">
                        <input type="hidden" value="1" id="last-index-xl" />
                        <input type="hidden" value="1" name="colors_indexes_xl" id="indexes-xl" />
                        <div class="col-12 mt-3 inputs_1_xl">
                            <input name="color_1_xl" type="color" class=" inputStock form-control form-control-color"
                                id="exampleColorInput" value="#563d7c" title="Choose your color">
                            <input required name="stock_1_xl" type="number"
                                class="form-control my-3  inputStock form-control-color" id="stock">
                            <button onclick="removeColor(event, 1, 'xl')" class="btn btn-danger inputStock btn-small"
                                id="btn-color-1-xl">x</button>
                        </div>
                    </div>

                </div>
                <div class="col-md-4">
                    <label for="inputState" class="form-label col-12  NomTaille">Taille 2XL</label>
                    <button onclick="addColor(event, 'xxl')" class="addcolor inputStock col-4">Add color</button>
                    <div class="colors-xxl col-12 d-flex">
                        <input type="hidden" value="1" id="last-index-xxl" />
                        <input type="hidden" value="1" name="colors_indexes_xxl" id="indexes-xxl" />
                        <div class="col-2 mt-3 inputs_1_xxl">
                            <input name="color_1_xxl" type="color" class=" inputStock form-control form-control-color"
                                id="exampleColorInput" value="#563d7c" title="Choose your color">
                            <input required name="stock_1_xxl" type="number"
                                class="form-control my-3 form-control-color inputStock" id="stock">
                            <button onclick="removeColor(event, 1, 'xxl')" class="btn btn-danger  inputStock btn-small"
                                id="btn-color-1-xxl">x</button>
                        </div>
                    </div>
                </div>
            </div>
            <button id="add-image" class="my-5 addcolor"> add all image for product </button>

            <div class="images-container">
                <input type="hidden" name="last_index_images" value="" class="" id="last-index-image" />
                <input type="hidden" name="colors_indexes_images" value="" class="" id="indexes-images" />
            </div>


            <div class="row">
                <div class="col-6">
                    <label for="" class="form-label my-3">Quel Catégorie</label>
                    <select id="categories" class="form-select col-4" aria-label="Default select example"
                        name="category_id">
                        <option selected value="{{ $categories[0]->id }}">{{ $categories[0]->libeleCateg }}</option>
                        @for ($i = 1; $i < count($categories); $i++)
                            <option value="{{ $categories[$i]->id }}">{{ $categories[$i]->libeleCateg }}</option>
                        @endfor
                    </select>
                </div>

                <div class="col-6">

                    <label for="" class="form-label my-3">Quel SubCatégorie</label>
                    @foreach ($categories as $category)
                        <select id="category-{{ $category->id }}"
                            class="category form-select col-4 {{ $category->id == 1 ? 'd-block' : 'd-none' }}"
                            aria-label="Default select example" name="sub_category_id">
                            @foreach ($category->subCategories as $subCategory)
                                <option value="{{ $subCategory->id }}">{{ $subCategory->title }}</option>
                            @endforeach
                        </select>
                    @endforeach
                </div>
            </div>
            <button type="submit" class="btn btn-primary my-4">Add Product</button>

        </form>
    </div>
    @livewireScripts
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
