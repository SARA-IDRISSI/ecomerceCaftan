function show_hide(event, index, size){
    event.preventDefault();
    if($(`.color-${index}`).hasClass("d-none")) {
        $(`.color-${index}`).removeClass("d-none").addClass('d-block');
        $("#size-input").val(size);
    } else if($(`.color-${index}`).hasClass("d-block")) {
        $(`.color-${index}`).removeClass("d-block").addClass('d-none');
        $("#size-input").val("");
    }
}
