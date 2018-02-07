export default {
  init() {
    // JavaScript to be fired on all pages
      //Mobile menu
      var $menu = $("#mobile-header-menu").mmenu({
         // options
      }, {
         // configuration
         offCanvas: {
            pageSelector: "#page-wrap",
         },
      });

      var $icon = $("#mobile-menu-button");
      var API = $menu.data( "mmenu" );

      $icon.on( "click", function() {
        API.open();
      });

      API.bind( "open:finish", function() {
         setTimeout(function() {
            $icon.addClass( "is-active" );
         }, 100);
      });
      API.bind( "close:finish", function() {
         setTimeout(function() {
            $icon.removeClass( "is-active" );
         }, 100);
      });

      //Search show and hide
      $('.search-tab > a').click(function(){
        if($('.search').hasClass('show')){
          $(".search").removeClass("show");
          if($(window).scrollTop() <= 50){
            $("body").removeClass("sticky");
          }
        }else{
          $(".search").addClass("show");
          $("body").addClass("sticky");
        }
      });

      //Sticky header
      $(window).scroll(function(){
        if($(this).scrollTop() >= 50){
          $("body").addClass("sticky");
        }else{
          $("body").removeClass("sticky");
        }
      });

      //Scroll past masthead
      $("#page-down").click(function() {
          $('html, body').animate({
              scrollTop: $('#top-content').offset().top  -113,
          }, 2000);
      });

      //Current page
      $( document ).ready(function() {
        var currentPage = window.location.href;
        var testEnv = currentPage.replace('http:', '');
        var menuItem = $('.nav-primary a[href="' + testEnv + '"]');
        menuItem.addClass('active-page');
        if(currentPage.includes("shop") || currentPage.includes("product")){
          $('.nav-primary a[href*="/shop/"]').addClass('active-page');
        }
      });

      //Current Product Category
      $( document ).ready(function() {
        var currentPage = window.location.pathname;
        var menuItem = $('a.product-cat[href="' + currentPage + '"]');
        menuItem.addClass('current-cat');
      });

      //Cart Quantity Buttons
      $('.minus-quantity').click( function(){
        var inputTotal = parseInt($('.input-text.qty.text').val());

        if(inputTotal > 1) {
          $('.input-text.qty.text').val(inputTotal - 1);
        }
      });

      $('.plus-quantity').click( function(){
        var inputTotal = parseInt($('.input-text.qty.text').val());
        $('.input-text.qty.text').val(inputTotal + 1);
      });

      //Instafeed
      var Instafeed = require("instafeed");
      new Instafeed({
         limit: 4,
         imageResolution: 'standard-resolution',
         accessToken: '4036430108.1677ed0.398bcb1c679143eeb1b3a15020e1fd5a',
         imageTemplate: `<a href="{{link}}" target="_blank" style="background-image:url({{image}})" class="insta-image"></a>`,
         videoTemplate: `<a href="{{link}}" target="_blank" style="background-image:url({{previewImage}})" class="insta-image"></a>`,
         carouselFrameTemplate: `<a href="{{link}}" target="_blank" style="background-image:url({{previewImage}})" class="insta-image"></a>`,
      }).run();

      $(document).ready(function(){
        $('.blog-slider').slick({
          responsive: [
           {
             breakpoint: 800,
             settings: {
               infinite: true,
             },
           },
         ],
        });
      });
  },
  finalize() {
    // JavaScript to be fired on all pages, after page specific JS is fired
  },
};
