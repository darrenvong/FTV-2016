/**
 * A quick (and probably temporary) "hot" fix for the committee grid on the about page.
 */
(function($) {

  /* Checkes whether there are num tiles in a row of the team gallery */
  function isNumTileInARow(gallery, tile, num) {
    const DELTA = 2;
    return ( Math.abs(tile.outerWidth(true) * num - gallery.outerWidth(true)) < DELTA );
  }

  /* Checks whether the class exists on the element first before adding it */
  function safeAddClass(element, cls) {
    if (element.size() > 0 && !element.hasClass(cls))
      element.addClass(cls);
  }

  /* Checks whether the class exists on the element first before removing it */
  function safeRemoveClass(element, cls) {
    if (element.size() > 0 && element.hasClass(cls))
      element.removeClass(cls);
  }

  function adjustGridDisplay() {
    var gallery = $(".team_gallery");
    var tile = $(".team-tile");
    // Tiles in the last, incomplete row (but still has three due to duplication)
    var first = $(".first"), second = $(".second"), third = $(".third");
    if (isNumTileInARow(gallery, tile, 3)) {
      // Screen wide enough to show 3 tiles, so turn first and third tile in
      // the incomplete row into dummy tiles by hiding them
      safeAddClass(first, "hide");
      safeRemoveClass(second, "null-display");
      safeAddClass(third, "hide");
      safeRemoveClass(third, "null-display");
    }
    else {
      // Screen only wide enough to show at most 2 tiles per row, so "move"
      // the real tile to where the first one is and don't display the other two tiles
      safeRemoveClass(first, "hide");
      safeAddClass(second, "null-display");
      safeAddClass(third, "null-display");
    }
  }

  $(() => {
    adjustGridDisplay();
    $(window).resize(adjustGridDisplay);
  });
})(window.jQuery || $);
