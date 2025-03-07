$(document).ready(function () {
    $('.btn-delete').click(function (e) {
        e.preventDefault();

        let url = $(this).data('url');
        $('#btn-submit').attr('href', url);
        $('#modal-delete-category').fadeIn();
    })

    $('.btn-cancel, #modal-delete-category').click(function (e) {
        if (e.target !== this) return;
        $('#modal-delete-category').fadeOut();
    })
})