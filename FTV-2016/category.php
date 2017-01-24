<?php include $config->paths->templates . "FTV-2016/header.php"; ?>

<div class="spacer"></div>

<!-- Category title -->
<h2 class="category">
  <span>
  <?php
    if ($page->template->name === "blog") {
      echo 'Read';
    } else {
      echo 'Watch';
    };
  ?> // </span>
  <?php
    if ($page->name === "videos") {
      echo 'All ';
    }
    echo $page->title;
  ?>
</h2>

<ul class="popular-cats">
  <?php
    if ($page->name !== "videos") {
      $video_cats = $pages->get("/videos/")->children("sort=-numChildren");
    }
    else {
      $video_cats = $page->children("sort=-numChildren");
    }

    foreach ($video_cats as $category) {
      echo "<li class='cat-item'><a href='$category->url'>{$category->title}</a></li>";
    }
  ?>
</ul>
<?php
  $limit = 10;
  $start = $input->urlSegment1 ? ($input->urlSegment1 - 1) * $limit : 0;
  $pageNum = $input->urlSegment1 ? : 1; // page number for pager

  if ($page->name === "videos") { // Find all videos if accessing from "Watch" link
    $results = $pages->find("(parent|other_cats=$video_cats), start=$start, limit=$limit, sort=-post_date");
  }
  else { // Find category specific videos only
    $results = $pages->find("(parent|other_cats=$page), start=$start, limit=$limit, sort=-post_date");
  }

  $first = true;
  foreach ($results as $post):
  
    //Declare variable for featured images
    $featured_img = $post->featured_image->url;
?>

<!-- Put the 1st post on the top banner -->
<?php
    if ($first) {
?>
      <section id="featured" class="live-banner">

        <div id="bg_img" style="background-image:url(<?php echo $featured_img; ?>)"></div>

        <div id="bg"></div>
        <div class="featured-info">

          <a href="http://forgetoday.com/tv"><span id="cat-back"><I class="fa fa-arrow-circle-left"></i> Home</span></a>

          <h4><?php displayCats($post); ?></h4>
          <h2><?php if ($post->upcoming_live) {
            ?><i class="fa fa-rss"></i> <?php
          } ?><?= $post->title; ?></h2>
          <p><?php echo trimExcerpt($post->excerpt); ?></p>
          <a href="<?= $post->url; ?>">
            <?php
              if( getCategories($post)->has("name=committee-blog") ) {
                 echo '<button id="watch-now">Read now <i class="fa fa-book"></i>';
              }
              else {
                echo '<button id="watch-now">Watch now <i class="fa fa-play"></i>';
              };
            ?>
            </button>
          </a>
        </div>

        <?php if ($post->upcoming_live) { ?>
          <div class="live-category-player">
            <script src="http:////content.jwplatform.com/players/idJNvXsO-i9raT3mC.js"></script>
          </div>
        <?php }; ?>

      </section>

      <section id="category">

<?php
      $first = false; // No longer the first post now that it's been outputted
    }
    else {
?>

    <div class="padder">
      <div class="tile">
        <div class="tile-image" style="background-image:url(<?php echo $featured_img; ?>)">
        </div>
        <div class="tile-info">
          <div class="triangle"></div>
          <h4><?php displayCats($post); ?></h4>
          <h2><?php if ($post->upcoming_live) {
            ?><i class="fa fa-rss"></i> <?php
          } ?><?= $post->title; ?></h2>
          <p><?php echo trimExcerpt($post->excerpt); ?></p>
          <div class="grad"></div>
        </div>
        <a href="<?= $post->url; ?>">
        <div class="cover"></div>
        </a>
      </div>
    </div>

<?php
    } //end if
  endforeach;
?>

</section>

<!-- ############################# EDITED UP TO HERE ###################################### -->


<!-- Pagination -->

<section id="pagination">
  <?php
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
  ?>
</section>

<?php include $config->paths->templates . "FTV-2016/footer.php"; ?>