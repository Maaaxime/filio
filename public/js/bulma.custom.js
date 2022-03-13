$(document).ready(function () {

    // Check for click events on the navbar burger icon
    $(".navbar-burger").click(function () {

        // Toggle the "is-active" class on both the "navbar-burger" and the "navbar-menu"
        $(".navbar-burger").toggleClass("is-active");
        $(".navigation").toggleClass("is-active");

    });

    $('.steps-segment a').click(function (e) {
        e.preventDefault();

        $('.steps-segment a').each(function () {
            $(this).parent().removeClass('is-active');
        });

        $(".tab-panel").each(function () {
            $(this).addClass('is-hidden');
        });

        if (!$(this).hasClass('is-active')) {
            $(this).parent().toggleClass('is-active');


            var panelId = '#' + $(this).attr("aria-controls");
            $(panelId).removeClass('is-hidden');
        }
    });

    const fileInput = document.querySelector('#file input[type=file]');
    if (fileInput !== null) {
        fileInput.onchange = () => {
            if (fileInput.files.length > 0) {
                const fileName = document.querySelector('#file .file-name');
                fileName.textContent = fileInput.files[0].name;
            }
        }
    }
});