$(document).ready(function () {
    $('#btn-close-alert').click(function (e) {
        e.preventDefault();
        $(this).parent().fadeOut();
    })
})