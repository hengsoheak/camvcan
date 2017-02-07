// FlexSlider Homepage Carousel
jQuery( document ).ready( function( $ ) {
	var $window = $(window),
      flexslider;
      // tiny helper function to add breakpoints
      
      function getGridSize() {
        return (window.innerWidth < 320) ? 1 :
               (window.innerWidth < 640) ? 2 : 
               (window.innerWidth < 960) ? 3 :
               (window.innerWidth < 1170) ? 4 : 5 ;
      } 
  $(window).load(function() {
      $('#carousel-home').flexslider({
        animation: "slide",
        controlNav: false,
        animationLoop: false,
        itemWidth: 438,
        itemMargin: 0,
        move: 1,
        minItems: getGridSize(),
        maxItems: getGridSize(),
      });
      $window.resize(function() {
        var gridSize = getGridSize();
        if (flexslider) {
        flexslider.vars.minItems = gridSize;
        flexslider.vars.maxItems = gridSize;
        }
      });
    });
});