<?php include $config->paths->templates . "FTV-2016/header.php"; ?>

<div class="spacer"></div>

<!-- Category title -->
<h2 class="category">
  <span>Browse // </span>
  <?= $page->title; ?>
</h2>

<!-- Query stuff here -->
<?php
  $photo_pages = $pages->find("template=video|single-gallery"); //PageArray
?>
<!-- Section id:category -->
<!-- MAY GO ON A REFACTORING SPREE LATER -->
<section id="category">
  <?php
    $image_id = 1;
    foreach ($photo_pages as $photo_page):
      if ($photo_page->template == "video"):
      /** Then this has the featured_image field with a single image
       * This also mean images here don't have tags, so use category to group by default
       * Useful image fields: url, description, width, height, original, page
       */
        if ($photo_page->featured_image):
  ?>
        <div class="padder gallery-padder">
          <div class="tile">
            <img class="gallery-image" src="<?= $config->urls->templates;?>img/default-placeholder.png"
              data-original="<?= $photo_page->featured_image->url; ?>" />
            <a href="#img<?= $image_id; ?>" rel="modal:open">
              <div class="cover"></div>
            </a>
          </div>
        </div>
        <div id="img<?= $image_id; ?>" style="display: none;">
          <div class="fotorama" data-auto="false" data-fit="cover" data-navwidth="100%"
          data-transition="crossfade" data-nav="thumbs" data-width="100%"
          data-ratio="16/9" data-loop="true" data-swipe="true" data-click="false">
            <a href="<?= $photo_page->featured_image->url;?>"
              data-thumb="<?= str_replace(".jpg", ".0x260.jpg", $photo_page->featured_image->url); ?>">
            </a>
            <?php

              $content_html = new DOMDocument();
              $content_html->loadHTML($photo_page->content);
              $video_url = $content_html->getElementsByTagName('iframe');

              foreach ($video_url as $vid):
                $embed_url = $vid->getAttribute('src');
                $matched = preg_match('#(?:https://www.youtube.com/embed/)+([\w]+)#', $embed_url, $matches);
                if ($matched):
                  echo "<a href='https://www.youtube.com/watch?v={$matches[1]}'></a>";
                endif;
              endforeach;

              $related_cats = getCategories($photo_page);
              $related_photo_pages = $pages->find("(parent|other_cats|image_cats=$related_cats), id!=$photo_page->id, sort=parent,
                sort=image_cats, sort=other_cats");

              foreach ($related_photo_pages as $rpp):
                if ($rpp->featured_image):
                  $thumb_url = str_replace(".jpg", ".0x260.jpg", $rpp->featured_image->url);
                  echo "<a href='{$rpp->featured_image->url}' data-thumb='$thumb_url'></a>";
                elseif (count($rpp->gallery_image) > 0):
                  foreach ($rpp->gallery_image as $single_img):
                    $thumb_url = str_replace(".jpg", ".0x260.jpg", $single_img->url);
                    echo "<a href='{$single_img->url}' data-thumb='$thumb_url'></a>";
                  endforeach;
                elseif ($rpp->external_image && count($rpp->external_image) > 0):
                  foreach ($rpp->external_image as $external_img):
                    echo "<a href='{$external_img->external_image_link}' data-thumb='$external_img->external_image_link'></a>";
                  endforeach;
                endif;
              endforeach;
            ?>
          </div>
        </div>
  <?php
        $image_id++;
        endif;
      else:
      /**
       * This is a gallery page with gallery_image field as a WireArray. Also
       * has external_image repeater containing links to external images. These
       * images have image_tag and categories, so group by tags first then
       * by categories.
       */

        $page_images = $photo_page->gallery_image;
        $external_images = $photo_page->external_image;

        //So first loop over all images ON this page...
        if (count($page_images) > 0):
          foreach ($page_images as $page_image):
  ?>
          <div class="padder gallery-padder">
            <div class="tile">
              <img class="gallery-image" src="<?= $config->urls->templates;?>img/default-placeholder.png"
                data-original="<?= $page_image->url; ?>" />
              <a href="#img<?= $image_id; ?>" rel="modal:open">
                <div class="cover"></div>
              </a>
            </div>
          </div>
          <div id="img<?= $image_id; ?>" style="display: none;">
            <div class="fotorama" data-auto="false" data-fit="cover" data-navwidth="100%"
            data-transition="crossfade" data-nav="thumbs" data-width="100%"
            data-ratio="16/9" data-loop="true" data-swipe="true" data-click="false">
              <a href="<?= $page_image->url;?>"
                data-thumb="<?= str_replace(".jpg", ".0x260.jpg", $page_image->url);?>">
              </a>
              <?php
                foreach ($page_images as $p_img):
                  if ($p_img->url == $page_image->url):
                    continue;
                  else:
                    $thumb_url = str_replace(".jpg", ".0x260.jpg", $p_img->url);
                    echo "<a href='{$p_img->url}' data-thumb='$thumb_url'></a>";
                  endif;
                endforeach;

                if (count($external_images) > 0):
                  foreach ($external_images as $ext_img):
                    echo "<a href='{$ext_img->external_image_link}' data-thumb='{$ext_img->external_image_link}'></a>";
                  endforeach;
                endif;
              ?>
            </div>
          </div>
  <?php
          $image_id++;
          endforeach;
        endif;

        //Then look at the external links and do it all over again...
        if (count($external_images) > 0):
          foreach ($external_images as $ext_img):
  ?>
          <div class="padder gallery-padder">
            <div class="tile">
              <img class="gallery-image" src="<?= $config->urls->templates;?>img/default-placeholder.png"
                data-original="<?= $ext_img->external_image_link;?>" />
              <a href="#img<?= $image_id; ?>" rel="modal:open">
                <div class="cover"></div>
              </a>
            </div>
          </div>
          <div id="img<?= $image_id; ?>" style="display: none;">
            <div class="fotorama" data-auto="false" data-fit="cover" data-navwidth="100%"
            data-transition="crossfade" data-nav="thumbs" data-width="100%"
            data-ratio="16/9" data-loop="true" data-swipe="true" data-click="false">
              <a href="<?= $ext_img->external_image_link;?>"
                data-thumb="<?= $ext_img->external_image_link;?>"></a>
              <?php
                foreach ($page_images as $page_image):
                  $thumb_url = str_replace(".jpg", ".0x260.jpg", $page_image->url);
                  echo "<a href='{$page_image->url}' data-thumb='$thumb_url'></a>";
                endforeach;

                foreach ($external_images as $ext_image):
                  if ($ext_image->external_image_link == $ext_img->external_image_link):
                    continue;
                  else:
                    echo "<a href='{$ext_image->external_image_link}' data-thumb='{$ext_image->external_image_link}'></a>";
                  endif;
                endforeach;
              ?>
            </div>
          </div>
  <?php
          $image_id++;
          endforeach;
        endif;
      endif; //The outer most if
    endforeach;
  ?>
</section>

<?php include $config->paths->templates . "FTV-2016/footer.php"; ?>
