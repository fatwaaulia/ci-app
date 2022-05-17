// PRELOADER
setTimeout(function () {
    $('.loader-bg').fadeToggle();
});


// IMAGE PREVIEW
$(".img-preview").change(function (event) {
    fadeInAdd();
    getURL(this);
});

$(".img-preview").on('click', function (event) {
    fadeInAdd();
});

function getURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        var filename = $(".img-preview").val();
        filename = filename.substring(filename.lastIndexOf('\\') + 1);
        reader.onload = function (e) {
            // debugger;
            $('#imgView').attr('src', e.target.result);
            $('#imgView').hide();
            $('#imgView').fadeIn(500);
            $('.custom-file-label').text(filename);
        }
        reader.readAsDataURL(input.files[0]);
    }
    $(".alert").removeClass("loadAnimate").hide();
}

function fadeInAdd() {
    fadeInAlert();
}
function fadeInAlert(text) {
    $(".alert").text(text).addClass("loadAnimate");
}


// HIDE VIEW PASSWORD
function password() {
    var x = document.getElementById("password");
    var show_eye = document.getElementById("show_eye");
    var hide_eye = document.getElementById("hide_eye");
    hide_eye.classList.remove("d-none");
    if (x.type === "password") {
        x.type = "text";
        show_eye.style.display = "none";
        hide_eye.style.display = "block";
    } else {
        x.type = "password";
        show_eye.style.display = "block";
        hide_eye.style.display = "none";
    }
}