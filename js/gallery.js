$(function() {
  $('.padder:not([class*="sect"].padder) img').show().lazyload({
    effect: "fadeIn"
  });
  $('[class*="sect"].padder img').show().lazyload({
    event: "click",
    effect: "fadeIn"
  });

  $('[data-remodal-id*="img"] div.fotorama').each(function(i, e) {
    var photoDiv = $(this).fotorama();
  });

  $('a[href*="#img"]').each(function() {
    $(this).click(function() {
      var modalID = $(this).attr("href").substring(1);
      var fotorama = $('[data-remodal-id="'+modalID+'"] div.fotorama').data('fotorama');
      // var fotorama = $($(this).attr("href")+" div.fotorama").data('fotorama');
      if (fotorama) { // The slideshow has been opened before
        fotorama.show({index: 0, time: 0});
      }
    });
  });

  var sectCounter = 1;
  $('#pagination button').click(function() {
    $('.sect'+sectCounter).toggleClass('sect'+sectCounter);
    $('.padder:not([class*="sect"].padder) img').trigger("click");
    sectCounter++;
    if ($('[class*="sect"].padder img').size() == 0) {
      $(this).parent().css("display", "none");
    }
  });

  $("button").click(function() {$(this).blur();});
});
