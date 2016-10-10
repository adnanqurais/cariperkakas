$(document).ready(function() {
    //Main Slide
    $("#owl-example").owlCarousel({
        autoPlay: 10000, //Set AutoPlay to 3 seconds
        stopOnHover : true,
        navigation : false,
        slideSpeed : 300,
        pagination : false,
        singleItem : true
    });

    $("#owl-example1").owlCarousel({
        autoPlay: 10000, //Set AutoPlay to 3 seconds
        stopOnHover : true,
        navigation : false,
        slideSpeed : 300,
        pagination : false,
        singleItem : true
    });

    // Main Slide
    $('#dekstop-slide').owlCarousel({
        autoplay:true,
        autoplayTimeout:5000,
        autoplayHoverPause:false,
        center: true,
        items:1,
        loop:true,
        margin:10,
        stopOnHover : true,
        autoHeight:true,
        slideSpeed : 300,
        pagination : false,
        paginationSpeed : 400,
        singleItem : true,
    });
    $('#top-promo').owlCarousel({
        autoplay:true,
        autoplayTimeout:5000,
        autoplayHoverPause:false,
        center: true,
        items:1,
        loop:true,
        margin:10,
        stopOnHover : true,
        autoHeight:true,
        slideSpeed : 300,
        pagination : false,
        paginationSpeed : 400,
        singleItem : true,
    });

    $('#productSlider').owlCarousel({
        autoplay:true,
        autoplayTimeout:5000,
        singleItem : true,
        loop:true,
        center: true,
        items: 1
    });

    $('#brandSlider').owlCarousel({
        autoplay:true,
        autoplayTimeout:5000,
        singleItem : true,
        loop:true,
        center: true,
        items: 1
    });
    //BRAND SLIDER
    $('#owl-brands').owlCarousel({
        loop:true,
        autoplay:true,
        autoplayTimeout:5000,
        autoplayHoverPause:false,
        responsiveClass:true,
        responsive:{
            0:{
                items:1,
                nav:true
            },
            600:{
                items:3,
                nav:false
            },
            1000:{
                items:5,
                nav:true,
                loop:false
            }
        },
        navigation : false,
        pagination : false
    });

    //Zoom image Product details
    $("#mobile-productdetail-image").owlCarousel({
        navigation : false,
        slideSpeed : 300,
        pagination : false,
        singleItem:true,
    });
});
