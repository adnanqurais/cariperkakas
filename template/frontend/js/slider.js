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

    //Mobile version Top Promo
    $("#owl-example1").owlCarousel({
        autoPlay: 10000, //Set AutoPlay to 3 seconds
        stopOnHover : true,
        navigation : false,
        slideSpeed : 300,
        pagination : false,
        singleItem : true,
        items:1,
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
        animateOut: 'fadeOut',
        animateIn: 'fadeIn',
        responsiveClass:true,
        responsive:{
            0:{
                items:1,
            },
            375:{
                items:1,
                loop:true
            },
            600:{
                items:1,
            },
            1000:{
                items:1,
                loop:true
            }
        },
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
        responsiveClass:true,
        responsive:{
            0:{
                items:1,
            },
            360:{
                items:1,
                loop:true
            },
            600:{
                items:1,
            },
            1000:{
                items:1,
                loop:true
            }
        },
    });

    $('#productSlider').owlCarousel({
        autoplay:true,
        autoplayTimeout:5000,
        singleItem : true,
        loop:true,
        center: true,
        items: 1,
        animateOut: 'fadeOut',
        animateIn: 'fadeIn',
    });

    $('#productSliderMobile').owlCarousel({
        autoplay:true,
        autoplayTimeout:5000,
        singleItem : true,
        loop:true,
        center: true,
        items: 1,
        animateOut: 'fadeOut',
        animateIn: 'fadeIn',
    });
    $('#productSlider1').owlCarousel({
        autoplay:true,
        autoplayTimeout:5000,
        singleItem : true,
        loop:true,
        items: 2,
        animateOut: 'fadeOut',
        animateIn: 'fadeIn',
    });

    $('#brandSlider').owlCarousel({
        autoplay:true,
        autoplayTimeout:5000,
        singleItem : true,
        loop:true,
        center: true,
        items: 1,
        animateOut: 'fadeOut',
        animateIn: 'fadeIn',
    });
    $('#productBrandsSliderMobile').owlCarousel({
        autoplay:true,
        autoplayTimeout:5000,
        singleItem : true,
        loop:true,
        center: true,
        items: 1,
        animateOut: 'fadeOut',
        animateIn: 'fadeIn',
    });

    $('#productBrandsSlider1').owlCarousel({
        autoplay:true,
        autoplayTimeout:5000,
        singleItem : true,
        loop:true,
        items: 2,
        animateOut: 'fadeOut',
        animateIn: 'fadeIn',
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

            },
            600:{
                items:3,
                nav:false
            },
            1000:{
                items:4,
                loop:true
            },
            1200:{
                items:5,
                loop:true
            },
            1400:{
                items:5,
                loop:true
            },
            1600:{
                items:5,
                loop:true
            }
        },
        nav : false,
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
