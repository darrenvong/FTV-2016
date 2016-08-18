$(function() {
  $("img.gallery-image").show().lazyload({
    effect: "fadeIn"
  });
  $('[id*="img"]').modal({fadeDuration: 1200});
  $('[id*="img"] div.fotorama').each(function(i, e) {
    var photoDiv = $(this).fotorama();
  });

  $('a[href*="#img"]').each(function() {
    $(this).click(function() {
      var fotorama = $($(this).attr("href")+" div.fotorama").data('fotorama');
      if (fotorama) { // The slideshow has been opened before
        fotorama.show({index: 0, time: 0});
      }
    });
  });
});
