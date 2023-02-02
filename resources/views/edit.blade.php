@extends('main')

@section('title', 'home')
@section('content')

        <div class="container row mx-auto">

        <div class="col-6 addProd">
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            @if(session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif
            <form action="" method="post" class="" enctype="multipart/form-data">
                @csrf
                <div>
                    <label for="" class="form-label">Title</label>
                    <input type="text" name="title" value="{{ $article->title }}" id="" class="form-control">
               </div>
            <div>
                <label for="" class="form-label">add image</label>
               <div> <img id="preview" alt="Article" class="w-50 h-50" src="/{{ $article->photo }}"></div>
                <input type="file" name="image" id="file" class="form-control" accept="image/*" onchange="previewImage();">
            </div>
       <div>
            <label for="" class="form-label">code bar</label>
            <input type="text" name="codebar" id="" value="{{ $article->barcode }}" class="form-control">
       </div>
       <div>
        <label for="" class="form-label">Description</label>
        <textarea name="description" id="" cols="30" rows="5" value="" class="form-control">{{ $article->description }}</textarea>
   </div>
  <div class="form-check form-switch">
    <input class="form-check-input" type="checkbox" role="switch" name="promo" id="flexSwitchCheckDefault">
    <label class="form-check-label" for="flexSwitchCheckDefault">Promo</label>
  </div>

  <div class="row">
    <div class="col-6">
        <label for="" class="form-label">prix encience</label>
        <input type="text" name="prixenciene" value="{{ $article->prix_actuel }}"id="" class="form-control">
    </div>
    <div class="col-6">
        <label for="" class="form-label">prix actuel</label>
        <input type="text" name="prixactuel" id="" value="{{ $article->prix_promotion }}" class="form-control">
    </div>
  </div>
  <div class="sizes">
    <input id="add-items" type="hidden" value="{{ implode(",", array_column($article->productSizes->toArray(), 'id')) }}" name="add_items" />
    <input id="delete-items" type="hidden" value="" name="delete_items" />
    @foreach($article->productSizes as $item)
    <div class="row g-3" id="container-size-{{ $item->id }}">
        <div class="col-md-4">
            <label for="inputState" class="form-label">Taille</label>
            <select id="inputState" class="form-select" name="size-{{ $item->id }}">
            <option selected value="{{ $item->size }}">{{ $item->size }}</option>
            @foreach ($sizes as $size)
                @if($size != $item->size)
                <option value="{{ $size }}">{{ $size }}</option>
                @endif
            @endforeach
            </select>
        </div>
        <div class="col-md-6">
            <label for="exampleColorInput" class="form-label">Couleur</label>
            <input name="color-{{ $item->id }}" type="color" value={{ $item->color }} class="form-control form-control-color" id="exampleColorInput" value="#563d7c" title="Choose your color">
        </div>
        <div class="col-md-6">
        <label for="stock" class="form-label">Stock</label>
        <input name="stock-{{ $item->id }}" type="number" value="{{ $item->stock }}" class="form-control form-control-color" id="stock">
        </div>
        <input type="hidden" name="size_id_{{ $item->id }}" value="{{ $item->id }}" />
        <button id="btn-size-{{ $item->id }}" onclick="addToDeleteItems(event, {{ $item->id }})">x</button>
    </div>
  @endforeach
  </div>
  <div class="col-12">
    <button id="add-size" class="btn btn-primary">Add Size</button>
  </div>

  <div>
    <label for="" class="form-label">Ajouter Catégorie</label>
    <select id="categories" class="form-select" aria-label="Default select example" name="category_id">
        <option selected value="{{ $article->category->id }}">{{ $article->category->libeleCateg }}</option>
        @for($i = 0; $i < count($categories); $i++)
            @if($article->category->id !== $categories[$i]->id)
                <option value="{{ $categories[$i]->id }}">{{ $categories[$i]->libeleCateg }}</option>
            @endif
        @endfor
      </select>
   </div>

   <div>
    <label for="" class="form-label">Ajouter SubCatégorie</label>
    <select id="category-{{ $article->category->id }}" class="category form-select d-block" aria-label="Default select example" name="sub_category_id">
        @foreach ($article->category->subCategories as $subCategory)
        <option value="{{ $subCategory->id }}">{{ $subCategory->title }}</option>
        @endforeach
    </select>
    @foreach ($categories as $category)
        @if($category->id != $article->category->id)
            <select id="category-{{ $category->id }}" class="category form-select d-none" aria-label="Default select example" name="sub_category_id">
                @foreach ($category->subCategories as $subCategory)
                <option value="{{ $subCategory->id }}">{{ $subCategory->title }}</option>
                @endforeach
            </select>
        @endif
    @endforeach
   </div>
     <button type="submit" class="btn btn-primary">Submit</button>
</form>
</div>
<script>
    const button = document.querySelector('#add-size');
const sizes = document.querySelector('.sizes');
let index = {{ count($article->productSizes) > 0 ? $article->productSizes[count($article->productSizes) - 1]->id : 0 }};

button.addEventListener('click', event => {
    event.preventDefault();
    index++;
    let values = `${document.querySelector("#add-items").value},${index}`;
    document.querySelector("#add-items").setAttribute("value", values);
    sizes.innerHTML += `<div class="row g-3" id="container-size-${index}">
    <div class="col-md-4">
        <label for="inputState" class="form-label">Taille</label>
        <select id="inputState" class="form-select" name="size-${index}">
          <option value="S" selected>S</option>
          <option value="M">M</option>
          <option value="L">L</option>
          <option value="XL">XL</option>

        </select>
      </div>
    <div class="col-md-6">
        <label for="exampleColorInput" class="form-label">Couleur</label>
        <input name="color-${index}" type="color" class="form-control form-control-color" id="exampleColorInput" value="#563d7c" title="Choose your color">
    </div>
    <div class="col-md-6">
      <label for="stock" class="form-label">Stock</label>
      <input name="stock-${index}" type="number" class="form-control form-control-color" id="stock">
    </div>
    <button id="btn-size-${index}" onclick="removeItem(event, ${index})">x</button>
  </div>`;
})

const removeItem = (event, index) => {
    event.preventDefault();
    document.querySelector(`#container-size-${index}`).remove();
    let values = document.querySelector("#add-items").value;
    document.querySelector("#add-items").setAttribute("value", values.slice(0, -2));
    index--;
}

const addToDeleteItems = (event, id) => {
    event.preventDefault();
    document.querySelector(`#container-size-${id}`).remove();
    let values = `${document.querySelector("#delete-items").value},${id}`;
    document.querySelector("#delete-items").setAttribute("value", values);
    let addItems = document.querySelector("#add-items").value;
    if(addItems.includes(id)) {
        addItems = addItems.replace(id, '');
        console.log(addItems);
        document.querySelector("#add-items").setAttribute("value", addItems);
    }
}

$categories = document.querySelector("#categories");

$categories.addEventListener("input", event => {
    let id = event.target.value;
    const subCategories = document.querySelectorAll('.category');
    Array.from(subCategories).forEach(subCategory => {
        subCategory.classList.remove('d-block');
        subCategory.classList.add('d-none');
    })
    document.querySelector(`#category-${id}`).classList.remove("d-none");
    document.querySelector(`#category-${id}`).classList.add("d-block");
})

</script>

@endsection
