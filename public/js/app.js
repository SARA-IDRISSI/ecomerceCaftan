const addColor = (event, size) => {
    event.preventDefault();
    console.log(size);
    let count = $(`#colors-${size}-number`).val();
    count++;
    $(`.colors-${size}`).append(`<input name="color-${count}-${size}" type="color" class="form-control form-control-color ms-2"
    id="exampleColorInput" value="#563d7c" title="Choose your color">`)
    $(`.colors-${size}`).append(`<button onclick="removeColor(event, ${count}, '${size}')" class="btn btn-primary btn-small"
    id="btn-color-${count}-${size}">x</button>`)
    $(`#colors-${size}-number`).val(count);
}

const removeColor = (event, index, size) => {
    event.preventDefault();
    $(`input[name="color-${index}-${size}"]`).remove();
    $(`#btn-color-${index}-${size}`).remove();
    let count = $(`#colors-${size}-number`).val();
    count--;
    $(`#colors-${size}-number`).val(count);
}

let i = 0;
$('#add-image').on('click', event => {
    i++;
    $('.images-container').append(`<div class="row">
        <input type="file" name="image_${i}" class="form-control form-control-file" />
        <input type="color" name="image_color_${i}" class="form-control form-control-color" />
        <button onclick="removeImage(event, ${i})" class"btn btn-small"></button>
    </div>`)
})

const removeImage = (event, index) => {

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
