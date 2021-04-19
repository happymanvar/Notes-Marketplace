$(".toggle-password").click(function() {

    var input = $($(this).attr("toggle"));
    if (input.attr("type") == "password") {
        input.attr("type", "text");
    } else {
        input.attr("type", "password");
    }
});

$(document).ready(function() {
    $('.publish-btn').click(function() {
        if (confirm('Are you sure you want to save this thing into the database?')) {
            return true;
        } else {
            return false;
        }
    });
});




/* ============================== Mobile Menu  ========================== */
$(document).ready(function() {

    //Show Mobile Navbar
    $("#mobile-nav-open-btn").click(function() {

        $("#mobile-nav").css("height", "100%");
        $("#mobile-nav-open-btn").css("display", "none");

    });

    //Hide Mobile Navbar
    $("#mobile-nav-close-btn, #mobile-nav a").click(function() {

        $("#mobile-nav").css("height", "0");
        $("#mobile-nav-open-btn").css("display", "block");

    });

});

$(document).ready(function() {

    $("nav .navbar-toggler").click(function() {
        $("body").toggleClass("mobile-menu-opened");
        $("nav.navbar").toggleClass("navbar-scroll-content");
        $("nav.navbar").toggleClass("navbar-fixed-height");
        $("nav.navbar").addClass("white-navbar");
    });

});

$(document).ready(function() {


    if ($(window).width() < 991) {
        $('#navbarSupportedContent').addClass('animate_animated animateslideInLeft animate_faster');
    } else {
        $('#navbarSupportedContent').removeClass('animate_animated animateslideInLeft animate_faster');
    }

});


$(document).ready(function() {
    // Add minus icon for collapse element which is open by default
    $(".collapse.show").each(function() {
        $(this).prev(".card-header").find("#img-faq").attr("src", "images/FAQ/add.png");
        $(this).parentsUntil(".card").css({
            "border": "1px solid #d1d1d1"
        });

    });

    // Toggle plus minus icon on show hide of collapse element
    $(".collapse").on('show.bs.collapse', function() {

        $(this).prev(".card-header").find(".img-faq").attr("src", "images/FAQ/minus.png").css({
            "height": "23px",
            "width": "35px"
        });
        $(this).prev(".card-header").css({
            "background": "white"
        });
        $(this).parent(".card").css("border", "1px solid #d1d1d1");

    }).on('hide.bs.collapse', function() {
        $(this).prev(".card-header").find(".img-faq").attr("src", "images/FAQ/add.png").css({
            "height": "38px",
            "width": "38px"
        });
        $(this).prev(".card-header").css({
            "background": "#f3f3f3"
        });
        $(this).parent(".card").css("border", "none");

    });
});

$(function() {
    $('.btn-logout').click(function() {
        if (confirm("Are you sure want to logout?")) {
            return true;
        } else {
            return false;
        }
    })
})
