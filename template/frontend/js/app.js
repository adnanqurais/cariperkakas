 $(document).ready(function() {

      //Product Detail Image
        $("#zoom_img").elevateZoom({gallery:'gal1', cursor: 'pointer', galleryActiveClass: 'active', imageCrossfade: true, loadingIcon: 'http://www.elevateweb.co.uk/spinner.gif'});
        //pass the images to Fancybox
        $("#zoom_img").bind("click", function(e) { var ez = $('#zoom_img').data('elevateZoom');	$.fancybox(ez.getGalleryList()); return false; });


      // Category Slider
          var $submenu = $('.submenu');
          var $mainmenu = $('.mainmenu');
          $submenu.hide();
          $submenu.first().delay(400).slideDown(700);
          $submenu.on('click','li', function() {
            $submenu.siblings().find('li').removeClass('chosen');
            $(this).addClass('chosen');
          });
          $mainmenu.on('click', 'li', function() {
            $(this).next('.submenu').slideToggle().siblings('.submenu').slideUp();
          });
          $mainmenu.children('li:last-child').on('click', function() {
            $mainmenu.fadeOut().delay(500).fadeIn();
          });

});

        // Menu Toggle Script
        jQuery(document).ready(function ($) {
            $('#mega-1').dcVerticalMegaMenu();
        });
        $(document).ready(function () {
            $(".menu-toggle").click(function (e) {
                e.preventDefault();
                $("#wrapper").toggleClass("toggled");
            });
        });
