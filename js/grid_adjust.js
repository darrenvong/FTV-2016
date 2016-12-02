/**
 * Fix for the committee grid on the about page when there's a singleton tile in the last row.
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

  /* Takes the given tile and insert it as a hidden dummy tile */
  function insertDummyTile(gallery, lastTile) {
    lastTile.addClass("last");
    var tileCopy = lastTile.clone().toggleClass("last last-p-one");
    var tileCopy2 = lastTile.clone().toggleClass("last last-p-two");
    gallery.append(tileCopy, tileCopy2);
    adjustGridDisplay(gallery, lastTile);
  }

  // Tiles named first, second, third are in the last, incomplete row
  // (but still has three due to duplication)
  // Updates the visibility status of the tiles in the last row dependent on
  // the availabe view port width.
  function adjustGridDisplay(gallery, tile) {
    var first = $(".last"), second = $(".last-p-one"), third = $(".last-p-two");
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
    var gallery = $(".team_gallery");
    var tile = $(".team-tile");
    if (tile.size() % 3 === 1) {
      insertDummyTile(gallery, tile.last());
      $(window).resize(() => { adjustGridDisplay(gallery, tile); });
    }
  });
})(window.jQuery || $);
