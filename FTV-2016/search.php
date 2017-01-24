<?php include_once $theme_path . "header.php"; ?>

<div class="spacer"></div>

<?php
  $query_string = $sanitizer->text($input->get("s"));
?>
<!-- Category title -->
<h2 class="category"><span>Search //</span> <?= (($query_string)? $sanitizer->entities($query_string) : ""); ?></h2>

<ul class="popular-cats">
  <?php
    $video_cats = $pages->get("/videos/")->children("sort=-numChildren");

    foreach ($video_cats as $category) {
      echo "<li class='cat-item'><a href='$category->url'>{$category->title}</a></li>";
    }
  ?>
</ul>

<?php
  /** The main search query processed **/
  if ($query_string):
    $input->whitelist("s", $query_string);

    $query_string = $sanitizer->selectorValue($query_string);

    /** Custom pagination setup **/
    $limit = 10;
    $start = $input->urlSegment1 ? ($input->urlSegment1 - 1) * $limit : 0;
    $pageNum = $input->urlSegment1 ? : 1; // page number for pager

    $selector = "title|content~=$query_string";
    if($user->isLoggedin()) $selector .= ", has_parent!=2, id!=1";
    $selector .= ", start=$start, limit=$limit, sort=-post_date";

    $results = $pages->find($selector);
    $first_post = true;

    if (count($results) > 0):
      foreach ($results as $r):
        $featured_img = $r->featured_image->url;
        if ($first_post):
?>
          <section id="featured">

            <div id="bg_img" style="background-image:url(<?php echo $featured_img; ?>)"></div>

            <div id="bg"></div>
            <div class="featured-info">

              <a href="<?= $config->urls->root; ?>"><span id="cat-back"><I class="fa fa-arrow-circle-left"></i> Home</span></a>

              <h4><?php displayCats($r); ?></h4>
              <h2><?= $r->title; ?></h2>
              <p><?= trimExcerpt($r->excerpt); ?></p>
              <a href="<?= $r->url; ?>"><button id="watch-now">Watch now <i class="fa fa-play"></i></button></a>
            </div>
          </section>
          <section id="category">
<?php
          $first_post = false;
        else:
?>
          <div class="padder">
            <div class="tile">
              <div class="tile-image" style="background-image:url(<?php echo $featured_img; ?>)">
              </div>
              <div class="tile-info">
                <div class="triangle"></div>
                <h4><?php displayCats($r); ?></h4>
                <h2><?= $r->title; ?></h2>
                <p><?= trimExcerpt($r->excerpt); ?></p>
                <div class="grad"></div>
              </div>
              <a href="<?= $r->url; ?>">
              <div class="cover"></div>
              </a>
            </div>
          </div>        
<?php         
        endif;
      endforeach;
    else:
      echo "<p>Sorry, no posts matched your criteria.</p>";
    endif;
  else:
    echo "<p>Sorry, no posts matched your criteria.</p>";
  endif;

?>

</section>

<!-- Pagination -->

<section id="pagination">
  <?php
    if ($results):
      $pagination = new PageArray();
      $pagination->setTotal($results->getTotal());
      $pagination->setLimit($limit);
      $pagination->setStart($start);
      $pagerHTML = $pagination->renderPager(array(
          "baseUrl" => $page->url,
          'nextItemLabel' => "Next >",
          'previousItemLabel' => "< Previous",
          'numPageLinks' => 3,
          'listMarkup' => "{out}",
          'linkMarkup' => "<a href='{url}'>{out}</a>",
          'currentLinkMarkup' => "<span class='current'>{out}</span>"
      ));
      
      $pagerHTML = str_replace("toreplaceprefix", "", $pagerHTML);

      echo $pagerHTML;
    endif;
  ?>
</section>

<?php include_once $theme_path . "footer.php"; ?>
