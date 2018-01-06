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
  },
  finalize() {
    // JavaScript to be fired on all pages, after page specific JS is fired
  },
};
