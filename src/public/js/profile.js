// masonry 
var $grid = $('.grid').masonry({
    itemSelector: '.grid-item',
    columnWidth: '.grid-sizer',
    percentPosition: true,
    transitionDuration: 0
});

$grid.imagesLoaded().progress( function() {
    $grid.masonry();
});

  