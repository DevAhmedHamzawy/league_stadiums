//wow
new WOW().init();

//header height
$(document).ready(function () {
    var headerHeight = $('header').outerHeight();
    $('body').css('padding-top', headerHeight);
});




//responsive nav
$(".nav-icon").click(function() {
    $("nav").toggleClass("open-nav");
    $(this).toggleClass("active-bar");
    
});




$(function() {
    var $win = $(window); // or $box parent container
    var $box = $(".nav-icon,nav");
    $win.on("click.Bst", function(event) {
        if (
            $box.has(event.target).length === 0 && //checks if descendants of $box was clicked
            !$box.is(event.target) //checks if the $box itself was clicked
        ) {
            $("nav").removeClass("open-nav");
            $(".nav-icon").removeClass("active-bar");
        }
    });
});






//img src change
$(".converted-img").each(function(i, elem) {
    var img_conv = $(elem);
       img_conv.parent(".full-width-img").css({
       backgroundImage: "url(" + img_conv.attr("src") + ")"
    });
  });



  //check
  $(".studuims-pg .studim-div .full-width-img").click(function(){
      $(this).toggleClass("check-stu");
  });

  //.load div
  $(function () {
    $(".load-div").slice(0, 9).show();
    $("#loadMore").on('click', function (e) {
        e.preventDefault();
        $(".load-div:hidden").slice(0, 3).slideDown();
        if ($(".load-div:hidden").length == 0) {
            $("#loadMore").fadeOut('slow');
        }
        $('html,body').animate({
            scrollTop: $(this).offset().top - 600
        }, 1500);
    });
});


//comment form
$(".rep-form-link").click(function() {
    $(this).parent().find('.replay-comment-form').slideDown('600', function() {
        // Slide the project to the top after clicking on it
        $('html, body').animate({
            scrollTop: $(this).parent().offset().top
        }, 500);
      });
});

    
    
//follow
$(".follow-btn").click(function() {
    $(this).toggleClass("active-follow");
    
});
  /*$(function () {

    $("div.holder1").jPages({
        containerID: "itemContainer",
        perPage:6

    });
  
});*/



//owl-carousel

$(".first-owl").owlCarousel({
    loop: true,
    margin: 0,
    items: 1,
    rtl:true,
    nav: true,
    dots: true,
    autoplay: true,
    touchDrag: true,
    mouseDrag: true,
 
});



$(".second-owl").owlCarousel({
    loop: true,
    margin: 0,
    items: 1,
    rtl:true,
    nav: true,
    dots: false,
    autoplay: true,
    touchDrag: true,
    mouseDrag: true,
    autoplayTimeout: 7000,
    animateOut: "flipOutY",
    animateIn: "flipInY"

});

$(".third-owl").owlCarousel({
    items: 4,
    margin:0,
    rtl:true,
    nav: true,
    dots: true,
    autoplay: true,
    touchDrag: true,
    mouseDrag: true,
    responsive: {
        0: {
            items: 1
        },
        576: {
            items: 2,
        },
        993: {
            items: 3
        },
        1000: {
            items: 4
        }
    }
 

});

$(".four-owl").owlCarousel({
    loop: true,
    margin: 0,
    items: 1,
    rtl:true,
    nav: false,
    dots: false,
    autoplay: true,
    touchDrag: true,
    mouseDrag: true
});

$(".five-owl").owlCarousel({
    items: 3,
    margin:30,
    rtl:true,
    nav: true,
    dots: true,
    autoplay: true,
    touchDrag: true,
    mouseDrag: true,
    responsive: {
        0: {
            items: 1
        },
        768: {
            items: 1,
        },
        993: {
            items: 2
        },
        
        1200: {
            items: 3
        }
    }
});




//file-upload

$('#chooseFile').bind('change', function () {
    var filename = $("#chooseFile").val();
    if (/^\s*$/.test(filename)) {
        $(".file-upload").removeClass('active');
        $("#noFile").text("");
    } else {
        $(".file-upload").addClass('active');
        $("#noFile").text(filename.replace("C:\\fakepath\\", ""));
    }
});



//file upload drag
$(document).ready(function() {
    $('.drag-input').imageuploadify();
});

//form validtion
(function() {
    'use strict';
    window.addEventListener('load', function() {
        // Fetch all the forms we want to apply custom Bootstrap validation styles to
        var forms = document.getElementsByClassName('needs-validation');
        // Loop over them and prevent submission
        var validation = Array.prototype.filter.call(forms, function(form) {
            form.addEventListener('submit', function(event) {
                if (form.checkValidity() === false) {
                    event.preventDefault();
                    event.stopPropagation();
                }
                form.classList.add('was-validated');
            }, false);
        });
    }, false);
})();