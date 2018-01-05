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
