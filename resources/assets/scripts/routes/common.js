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
              scrollTop: $("#top-content").offset().top  -113,
          }, 2000);
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

      //Instafeed
      // get: 'manifesto_coffee',
      // userID: '4036430108',
      // accessToken: '34738358.1677ed0.00a02a10c6594093a2b59f96d374d73b',
      // limit: 4,
      // imageResolution: 'standard-resolution',
      // new Instafeed({
      //     accessToken: "34738358.1677ed0.00a02a10c6594093a2b59f96d374d73b",
      // }).run()
      var Instafeed = require("instafeed");
      new Instafeed({
         limit: 4,
         imageResolution: 'standard-resolution',
         accessToken: '4036430108.1677ed0.398bcb1c679143eeb1b3a15020e1fd5a',
         imageTemplate: `<a href="{{link}}" target="_blank" style="background-image:url({{image}})" class="insta-image"></a>`,
         videoTemplate: `<a href="{{link}}" target="_blank" style="background-image:url({{previewImage}})" class="insta-image"></a>`,
         carouselFrameTemplate: `<a href="{{link}}" target="_blank" style="background-image:url({{previewImage}})" class="insta-image"></a>`,
       }).run()
  },
  finalize() {
    // JavaScript to be fired on all pages, after page specific JS is fired
  },
};
