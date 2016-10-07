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
      // $("#dekstop-slide").owlCarousel({

      // autoPlay: 10000, //Set AutoPlay to 3 seconds
      // stopOnHover : true,
      // navigation : true,
      //     navigationText: [
      //     "<i class='icon ion-ios-arrow-left' style=\"font-size:70px;\"></i>",
      //     "<i class='icon ion-ios-arrow-right' style=\"font-size:70px;\"></i>"
      // ],
      // slideSpeed : 300,
      // pagination : false,
      // paginationSpeed : 400,
      // singleItem : true,
      // });
      $('#dekstop-slide').owlCarousel({
          autoplay:true,
          autoplayTimeout:5000,
          autoplayHoverPause:false,
          center: true,
          items:1,
          loop:true,
          margin:10,
          stopOnHover : true,
          // nav : true,
          // navText: ["<i class='icon ion-ios-arrow-left' style='font-size:70px;'></i>",
          //          "<i class='icon ion-ios-arrow-right' style='font-size:70px;'></i>"
          //          ],
          autoHeight:true,
      slideSpeed : 300,
      pagination : false,
      paginationSpeed : 400,
      singleItem : true,
      });

      //Product Slide
      // $("#productSlider").owlCarousel({

      // autoPlay: 10000, //Set AutoPlay to 3 seconds
      // stopOnHover : true,
      // navigation : true,
      // navigationText: [
      //     "<i class='icon ion-ios-arrow-left' style=\"font-size:70px;\"></i>",
      //     "<i class='icon ion-ios-arrow-right' style=\"font-size:70px;\"></i>"
      // ],
      // slideSpeed : 300,
      // paginationSpeed : 400,
      // singleItem : true
      // });


      //BRAND SLIDER
      var owl = $("#owl-brands");
      owl.owlCarousel({
      autoPlay: 3000, //Set AutoPlay to 3 seconds
      stopOnHover : true,
      itemsCustom : [
            [0, 1],
            [450, 2],
            [600, 3],
            [700, 3],
            [1000, 4],
            [1200, 5],
            [1400, 5],
            [1600, 5]
          ],
      navigationText: [
          "<i class='icon ion-ios-arrow-left'></i>",
          "<i class='icon ion-ios-arrow-right'></i>"
          ],
      navigation : false,
      pagination : false
      });

      //Zoom image Product details
      $("#mobile-productdetail-image").owlCarousel({
          navigation : false, // Show next and prev buttons
          slideSpeed : 300,
          pagination : false,
          singleItem:true
      });
 });
