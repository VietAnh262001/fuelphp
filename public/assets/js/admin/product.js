$(document).ready(function () {
    const inputFile = $('.image');
    const preview = $('#preview-image');
    const image = preview.find('img');

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

    $('.btn-delete').click(function (e) {
        e.preventDefault();

        let url = $(this).data('url');
        $('#btn-submit').attr('href', url);
        $('#modal-delete-product').fadeIn();
    })

    $('.btn-cancel, #modal-delete-product').click(function (e) {
        if (e.target !== this) return;
        $('#modal-delete-product').fadeOut();
    })
})