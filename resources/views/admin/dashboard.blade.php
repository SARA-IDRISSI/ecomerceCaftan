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
@extends('main')
@section('title', 'admin')
@section('content')

    <main>


        <div class="container mx-auto row">
            <div class="col-4 admin bg-red my-3 bg-dark">
                <div class="col-12 my-5 fs-1 text-white text-center">ADMIN</div>
                <div class="col-12 border-top border-bottom py-5 text-white text-center">Profile</div>
                <div class="col-12 border-top border-bottom py-5 text-white text-center"><a href="/allProduct">AllProduct</a>
                </div>
                <div class="col-12 border-top border-bottom py-5 text-white text-center"><a
                        href="/add-category">AddCatégories</a></div>
                <div class="col-12 border-top border-bottom py-5 text-white text-center"><a
                        href="/add-subcategory">SubCatégories</a></div>
            </div>
            {{-- formulaire ajouter produit --}}

            <div class="col-1"></div>
            <div class="col-6 addProd">
                @if (session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif
                @if (session('error'))
                    <div class="alert alert-danger">{{ session('error') }}</div>
                @endif
                <form action="{{ route('post-product') }}" method="post" class="" enctype="multipart/form-data">
                    @csrf
                    <div>
                        <label for="" class="form-label">Title</label>
                        <input type="text" name="title" id="" class="form-control">
                    </div>
                    <div>
                        <label for="" class="form-label">add image</label>
                        <div> <img id="preview" alt="Article" class="w-50 h-50"></div>
                        <input type="file" name="image" id="file" class="form-control" accept="image/*"
                            onchange="previewImage();">
                    </div>
                    <div>
                        <label for="" class="form-label">code bar</label>
                        <input type="text" name="codebar" id="" class="form-control">
                    </div>
                    <div>
                        <label for="" class="form-label">Description</label>
                        <textarea name="description" id="" cols="30" rows="5" class="form-control"></textarea>
                    </div>



                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" role="switch" name="promo"
                            id="flexSwitchCheckDefault">
                        <label class="form-check-label" for="flexSwitchCheckDefault">Promo</label>
                    </div>




                    <div class="row">
                        <div class="col-6">
                            <label for="" class="form-label">prix encience</label>
                            <input type="text" name="prixenciene" id="" class="form-control">
                        </div>
                        <div class="col-6">
                            <label for="" class="form-label">prix actuel</label>
                            <input type="text" name="prixactuel" id="" class="form-control">
                        </div>
                    </div>
                    <div class="sizes">
                        <input id="count-size" type="hidden" value="0" name="size_count" />
                    </div>
                    {{-- <div class="col-12">
        <button id="add-size" class="btn btn-primary">Add Size</button>
      </div> --}}

                    {{-- <div class="row">
    <div class="col-5">
        <label for="" class="form-label">la taille</label>
        <input type="text" name="" id="" class="form-control">
     </div>
     <div class="col-2">
        <label for="" class="form-label">color</label>
        <input type="color" name="" id="" class="form-control">
     </div>
     <div class="col-5">
        <label for="" class="form-label">stock</label>
        <input type="text" name="" id="" class="form-control">
     </div>
   </div>

   <div class="row">
    <div class="col-5">
        <label for="" class="form-label">la taille</label>
        <input type="text" name="" id="" class="form-control">
     </div>
     <div class="col-2">
        <label for="" class="form-label">color</label>
        <input type="color" name="" id="" class="form-control">
     </div>
     <div class="col-5">
        <label for="" class="form-label">stock</label>
        <input type="text" name="" id="" class="form-control">
     </div>
   </div>

   <div class="row">
    <div class="col-5">
        <label for="" class="form-label">la taille</label>
        <input type="text" name="" id="" class="form-control">
     </div>
     <div class="col-2">
        <label for="" class="form-label">color</label>
        <input type="color" name="" id="" class="form-control">
     </div>
     <div class="col-5">
        <label for="" class="form-label">stock</label>
        <input type="text" name="" id="" class="form-control">
     </div>
   </div>

   <div class="row">
    <div class="col-5">
        <label for="" class="form-label">la taille</label>
        <input type="text" name="" id="" class="form-control">
     </div>
     <div class="col-2">
        <label for="" class="form-label">color</label>
        <input type="color" name="" id="" class="form-control">
     </div>
     <div class="col-5">
        <label for="" class="form-label">stock</label>
        <input type="text" name="" id="" class="form-control">
     </div>
   </div>
   <div class="row">
    <div class="col-5">
        <label for="" class="form-label">la taille</label>
        <input type="text" name="" id="" class="form-control">
     </div>
     <div class="col-2">
        <label for="" class="form-label">color</label>
        <input type="color" name="" id="" class="form-control">
     </div>
     <div class="col-5">
        <label for="" class="form-label">stock</label>
        <input type="text" name="" id="" class="form-control">
     </div>
   </div> --}}
                    {{-- tailles --}}
                    <hr>
                    <div class="row g-3">
                        <div class="col-md-4">
                            <label for="inputState" class="form-label">Taille XS</label>
                            <input type="text" name="" id="" value="XS" disabled>
                            <label for="exampleColorInput" class="form-label">Couleur</label>
                            <button onclick="addColor(event, 'xs')">Add color</button>
                            <div class="colors-xs d-flex">
                                <input type="hidden" value="1" id="colors-xs-number" />
                                <input name="color-1-xs" type="color" class="form-control form-control-color"
                                    id="exampleColorInput" value="#563d7c" title="Choose your color">
                                <button onclick="removeColor(event, 1, 'xs')" class="btn btn-primary btn-small"
                                    id="btn-color-1-xs">x</button>
                            </div>
                            <label for="stock" class="form-label">Stock</label>
                            <input name="stock-xs" type="number" class="form-control form-control-color"
                                id="stock">

                        </div>

                        <hr>
                        {{--  --}}
                        <div class="row g-3">
                            <div class="col-md-4">
                                <label for="inputState" class="form-label">Taille S</label>
                                <input type="text" name="" id="" value="S" disabled>
                                <label for="exampleColorInput" class="form-label">Couleur</label>
                                <button onclick="addColor(event, 's')">Add color</button>
                                <div class="colors-s d-flex">
                                    <input type="hidden" value="1" id="colors-s-number" />
                                    <input name="color-1-s" type="color" class="form-control form-control-color"
                                        id="exampleColorInput" value="#563d7c" title="Choose your color">
                                    <button onclick="removeColor(event, 1, 's')" class="btn btn-primary btn-small"
                                        id="btn-color-1-s">x</button>
                                </div>
                            </div>
                            <div>
                                <label for="stock" class="form-label">Stock</label>
                                <input name="stock-s" type="number" class="form-control form-control-color"
                                    id="stock-s">
                            </div>
                        </div>
                        <hr>
                        {{--  --}}
                        <div class="row g-3">
                            <div class="col-md-4">
                                <label for="inputState" class="form-label">Taille M</label>
                                <input type="text" name="" id="" value="M" disabled>
                                <label for="exampleColorInput" class="form-label">Couleur</label>
                                <button onclick="addColor(event, 'm')">Add color</button>
                                <div class="colors-m d-flex">
                                    <input type="hidden" value="1" id="colors-m-number" />
                                    <input name="color-1-m" type="color" class="form-control form-control-color"
                                        id="exampleColorInput" value="#563d7c" title="Choose your color">
                                    <button onclick="removeColor(event, 1, 'm')" class="btn btn-primary btn-small"
                                        id="btn-color-1-m">x</button>
                                </div>
                                <label for="stock" class="form-label">Stock</label>
                                <input name="stock-m" type="number" class="form-control form-control-color"
                                    id="stock">
                            </div>
                        </div>
                        <hr>
                        {{--  --}}
                        <div class="row g-3">
                            <div class="col-md-4">
                                <label for="inputState" class="form-label">Taille L</label>
                                <input type="text" name="" id="" value="L" disabled>

                                <label for="exampleColorInput" class="form-label">Couleur</label>
                                <button onclick="addColor(event, 'l')">Add color</button>
                                <div class="colors-l d-flex">
                                    <input type="hidden" value="1" id="colors-l-number" />
                                    <input name="color-1-l" type="color" class="form-control form-control-color"
                                        id="exampleColorInput" value="#563d7c" title="Choose your color">
                                    <button onclick="removeColor(event, 1, 'l')" class="btn btn-primary btn-small"
                                        id="btn-color-1-l">x</button>
                                </div>

                                <label for="stock" class="form-label">Stock</label>
                                <input name="stock-l" type="number" class="form-control form-control-color"
                                    id="stock">

                            </div>
                        </div>
                        <hr>
                        {{--  --}}
                        <div>
                            <div class="col-md-4">
                                <label for="inputState" class="form-label">Taille XL</label>
                                <input type="text" name="" id="" value="XL" disabled>
                                <label for="exampleColorInput" class="form-label">Couleur</label>
                                <button onclick="addColor(event, 'xl')">Add color</button>
                                <div class="colors-xl d-flex">
                                    <input type="hidden" value="1" id="colors-xl-number" />
                                    <input name="color-1-xl" type="color" class="form-control form-control-color"
                                        id="exampleColorInput" value="#563d7c" title="Choose your color">
                                    <button onclick="removeColor(event, 1, 'xl')" class="btn btn-primary btn-small"
                                        id="btn-color-1-xl">x</button>
                                </div>
                                <label for="stock" class="form-label">Stock</label>
                                <input name="stock-xl" type="number" class="form-control form-control-color"
                                    id="stock">



                            </div>
                        </div>
                        <hr>
                        {{--  --}}
                        <div>
                            <div class="col-md-4">
                                <label for="inputState" class="form-label">Taille 2XL</label>
                                <input type="text" name="" id="" value="2XL" disabled>

                                <label for="exampleColorInput" class="form-label">Couleur</label>
                                <button onclick="addColor(event, 'xxl')">Add color</button>
                                <div class="colors-xxl d-flex">
                                    <input type="hidden" value="1" id="colors-xxl-number" />
                                    <input name="color-1-xxl" type="color" class="form-control form-control-color"
                                        id="exampleColorInput" value="#563d7c" title="Choose your color">
                                    <button onclick="removeColor(event, 1, 'xxl')" class="btn btn-primary btn-small"
                                        id="btn-color-1-xxl">x</button>
                                </div>
                                <label for="stock" class="form-label">Stock</label>
                                <input name="stock-xxl" type="number" class="form-control form-control-color"
                                    id="stock">



                            </div>
                        </div>
                    </div>

                    <hr>
                    {{--  --}}
                    {{-- <div class="col-md-6">
        <label for="exampleColorInput" class="form-label">Couleur</label>
        <input name="color-${i}" type="color" class="form-control form-control-color" id="exampleColorInput" value="#563d7c" title="Choose your color">
    </div>
    <div class="col-md-6">
      <label for="stock" class="form-label">Stock</label>
      <input name="stock-${i}" type="number" class="form-control form-control-color" id="stock">
    </div> --}}

                    <button id="add-image" onclick="addImage(event)"> add image </button>
                    <div class="images-container">
                        <input type="hidden" value="0" id="count-images" />
                    </div>
                    <div>
                        <label for="" class="form-label">Ajouter Catégorie</label>
                        <select id="categories" class="form-select" aria-label="Default select example"
                            name="category_id">
                            <option selected value="{{ $categories[0]->id }}">{{ $categories[0]->libeleCateg }}</option>
                            @for ($i = 1; $i < count($categories); $i++)
                                <option value="{{ $categories[$i]->id }}">{{ $categories[$i]->libeleCateg }}</option>
                            @endfor
                        </select>
                    </div>

                    <div>
                        <label for="" class="form-label">Ajouter SubCatégorie</label>
                        @foreach ($categories as $category)
                            <select id="category-{{ $category->id }}"
                                class="category form-select {{ $category->id == 1 ? 'd-block' : 'd-none' }}"
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.min.js"
        integrity="sha512-STof4xm1wgkfm7heWqFJVn58Hm3EtS31XFaagaa8VMReCXAkQnJZ+jEy8PCC/iT18dFy95WcExNHFTqLyp72eQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="{{ asset('js/app.js') }}"></script>
@endsection
