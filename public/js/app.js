const button = document.querySelector('#add-size');
const sizes = document.querySelector('.sizes');
let i = 0;

button.addEventListener('click', event => {
    event.preventDefault();
    i++;
    document.querySelector("#count-size").setAttribute("value", i);
    sizes.innerHTML += `<div class="row g-3" id="container-size-${i}">
    <div class="col-md-4">
        <label for="inputState" class="form-label">Taille</label>
        <select id="inputState" class="form-select" name="size-${i}">
          <option value="S" selected>S</option>
          <option value="M">M</option>
          <option value="L">L</option>
          <option value="XL">XL</option>

        </select>
      </div>
    <div class="col-md-6">
        <label for="exampleColorInput" class="form-label">Couleur</label>
        <input name="color-${i}" type="color" class="form-control form-control-color" id="exampleColorInput" value="#563d7c" title="Choose your color">
    </div>
    <div class="col-md-6">
      <label for="stock" class="form-label">Stock</label>
      <input name="stock-${i}" oninput="handleStockChange()" type="number" class="form-control form-control-color" id="stock">
    </div>
    <button id="btn-size-${i}">x</button>
  </div>`;
  document.querySelector(`#btn-size-${i}`).addEventListener("click", (event) => {
    event.preventDefault();
    document.querySelector(`#container-size-${i}`).remove();
    i--;
    document.querySelector("#count-size").setAttribute("value", i);
  })
})

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
