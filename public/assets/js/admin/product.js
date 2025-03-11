$(document).ready(function () {
    const inputFile = $('.image');
    const preview = $('#preview-image');
    const image = preview.find('img');
    const textError = $('.text-error-image');
    const maxSizeImage = 2 * 1024 * 1024;

    $('.btn-image').click(function (e) {
        e.preventDefault();
        inputFile.click();
    })

    inputFile.change(function () {
        const file = this.files[0];
        const validTypes = ['image/jpeg', 'image/png'];
        if (file) {
            if (!validTypes.includes(file.type)) {
                uploadError('Image must be a PNG or JPEG image')
                return;
            }
            if (file.size > maxSizeImage) {
                uploadError('Please upload images under 2mb')
                return;
            }

            const reader = new FileReader();
            reader.onload = function (e) {
                image.attr('src', e.target.result);
                preview.show();
            };
            reader.readAsDataURL(file);
        }
    })

    function uploadError(text) {
        preview.hide();
        image.attr('src', '#');
        inputFile.val('');
        textError.text(text);
    }

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