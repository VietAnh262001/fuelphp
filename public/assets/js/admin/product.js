$(document).ready(function () {
    const inputFile = $('.image');
    const removeFile = $('input[name="remove_image"]');
    const preview = $('#preview-image');
    const image = preview.find('img');
    const deleteButton = preview.find('.delete-image');

    $('.btn-image').click(function (e) {
        e.preventDefault();
        inputFile.click();
    })

    inputFile.change(function () {
        const file = this.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function (e) {
                image.attr('src', e.target.result);
                preview.show();
            };
            reader.readAsDataURL(file);
        }
    })

    deleteButton.click(function (e) {
        e.preventDefault();

        preview.hide();
        image.attr('src', '#');
        inputFile.val('');
    })
})