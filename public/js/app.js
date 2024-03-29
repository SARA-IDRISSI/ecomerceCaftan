const addColor = (event, size) => {
    event.preventDefault();
    let lastIndex = $(`#last-index-${size}`).val() ? $(`#last-index-${size}`).val() : 0;
    let indexes = $(`#indexes-${size}`).val();
    lastIndex++;
    $(`.colors-${size}`).append(`<div class="col-12 mt-3 inputs_${lastIndex}_${size}">
        <input name="color_${lastIndex}_${size}" type="color" class="form-control inputStock form-control-color "
    id="exampleColorInput" value="#563d7c" title="Choose your color">
        <input name="stock_${lastIndex}_${size}" type="number"  placeholder="Qty"
    class="form-control my-3 inputStock form-control-color" id="stock">
    <button onclick="removeColor(event, ${lastIndex}, '${size}')" class="btn btn-danger inputStock btn-small"
    id="btn-color-${lastIndex}-${size}">x</button>
    </div>`)
    $(`#indexes-${size}`).val(`${indexes}${lastIndex}`);
    $(`#last-index-${size}`).val(lastIndex);
}

const removeColor = (event, index, size) => {
    event.preventDefault();
    let lastIndex = $(`#last-index-${size}`).val();
    if(index == lastIndex) {
        lastIndex--;
        $(`#last-index-${size}`).val(lastIndex);
    }

    $(`.inputs_${index}_${size}`).remove();
    let indexes = $(`#indexes-${size}`).val().replace(index, '');
    $(`#indexes-${size}`).val(indexes);
}

$('#add-image').on('click', event => {
    event.preventDefault();
    let lastIndex = $(`#last-index-image`).val();
    let i = lastIndex ? lastIndex : 0;
    i++;
    let indexes = $(`#indexes-images`).val();
    $(`#count-images`).val(i);
    $('.images-container').append(`<div class="row col-4" id="image-container-${i}">
        <input oninput="handleImageChange(event, ${i})" type="file" name="image_${i}" id="image-file-${i}" class="form-control form-control-file" />
        <input type="color" name="image_color_${i}" class="form-control my-3 form-control-color" />
        <button onclick="removeImage(event, ${i})" class="btn btn-danger btn-small  mb-3">x</button>
    </div>`)
    $(`#indexes-images`).val(`${indexes}${i}`);
    $(`#last-index-image`).val(i);
})

const removeImage = (event, index) => {
    event.preventDefault();
    $(`#image-container-${index}`).remove();
    let lastIndex = $(`#last-index-image`).val();
    if(index == lastIndex) {
        lastIndex--;
        $(`#last-index-image`).val(lastIndex);
    }
    let indexes =  $(`#indexes-images`).val().replace(index, '');
    $(`#indexes-images`).val(indexes);
}

const handleImageChange = (event, index) => {
    $(`#image-file-${index}`).after(`<img src="${URL.createObjectURL(event.target.files[0])}" class="img-fluid" alt="${event.target.files[0].name}" />`);
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

