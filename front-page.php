<?php include $config->paths->templates . "FTV-2016/header.php"; ?>

<section id="hero">

  <div id="bg_img" style="background-image: url(<?= $config->urls->templates; ?>FTV-2016/img<?php displayRandom(); ?>)"></div>
  <div id="bg"></div>

  <img id="logo" src="<?= $config->urls->templates; ?>FTV-2016/img/logo.png" />
  <div class="divider"></div>
  <span id="slogan"><?=$page->tagline; ?></span>

  <a href="#latest" class="cue"><i class="fa fa-arrow-down fa-3x cue"></i></a>

</section>


<!-- Latest videos -->

<section id="latest">

  <?php
    // Grab all posts with the video categories or live as parent
    $video_cats = $pages->get("/videos/")->children;
    $live_cat = $pages->get("/live/");
    $results = $pages->find("parent=$video_cats|$live_cat, limit=6, sort=-post_date");

    foreach ($results as $post):
      $featured_img = $post->featured_image->url;
  ?>

        <div class="padder">
          <div class="tile">
            <div class="tile-image" style="background-image:url(<?php echo $featured_img; ?>)">
            </div>
            <div class="tile-info">
              <div class="triangle"></div>
              <h4><?php displayCats($post); ?></h4>
              <h2>
                <?php
                  $post_cats = getCategories($post);
                  if ($post->upcoming_live === 1):
                ?>    <i class="fa fa-rss"></i>
                <?php
                  endif;
                ?>
              <?= $post->title; ?></h2>
              <p><?php echo trimExcerpt($post->excerpt); ?></p>
              <div class="grad"></div>
            </div>
            <a href="<?= $post->url; ?>">
            <div class="cover"></div>
            </a>
          </div>
        </div>

    <?php endforeach; ?>
</section>


<?php
  $featured_query = $pages->findOne("parent=/videos/features/, id!=$results, sort=-post_date");

  if ( $featured_query->id !== 0 ) {
    $featured_img = $featured_query->featured_image->url;
    ?>

    <section id="featured">

      <div id="bg_img" style="background-image:url(<?php echo $featured_img; ?>)"></div>

      <div id="bg"></div>
      <div class="featured-info">
        <h4><?php displayCats($featured_query); ?></h4>
        <h2><?php if ($featured_query->upcoming_live) {
          ?><i class="fa fa-rss"></i> <?php
        } ?><?= $featured_query->title; ?></h2>
        <p><?php echo trimExcerpt($featured_query->excerpt); ?></p>
        <a href="<?= $featured_query->url; ?>"><button id="watch-now">Watch now <i class="fa fa-play"></i></button></a>
      </div>
    </section>

        <?php
  } // end if
?>

<section id="services">
  <div class="column">
    <div class="service">
      <div class="flex-image" style="background-image:url(<?= $config->urls->templates; ?>FTV-2016/img/get_involved.jpg)"></div>
      <div class="flex-content">
        <h4>Get involved</h4>
        <h3>Join our team</h3>
        <p>There are no membership fees or applications, and absolutely no experience is needed.</p>
        <a href="tv/get-involved"><button>Find out how</button></a>
      </div>
    </div>
  </div>
  <div class="column">
    <div class="service hover">
      <div class="flex-image" style="background-image:url(<?= $config->urls->templates; ?>FTV-2016/img/hire_us.jpg)"></div>
      <div class="flex-content">
        <h4>Services</h4>
        <h3>Hire us</h3>
        <p>Give your event the high-definition reception it deserves.</p>
      </div>
      <a href="/tv/hire">
        <div class="cover"></div>
      </a>
    </div>

    <?php
      $latest_blog_post = $pages->findOne("parent=/committee-blog/, sort=-post_date");

      if ( $latest_blog_post->id !== 0 ) {

        $featured_img = $latest_blog_post->featured_image->url;
        ?>

          <div class="service hover">
            <div class="flex-image" style="background-image:url(<?php echo $featured_img ?>)"></div>
            <div class="flex-content">
              <h4>Latest blog post</h4>
              <h3><?= $latest_blog_post->title; ?></h3>
              <p><?php echo trimExcerpt($latest_blog_post->excerpt); ?></p>
            </div>

            <a href="<?= $latest_blog_post->url ?>">
              <div class="cover"></div>
            </a>

          </div>

            <?php
      } // end if
    ?>
  </div>
</section>

<?php
  include_once $config->paths->templates . "FTV-2016/contact.php";
  include_once $config->paths->templates . "FTV-2016/footer.php";
?>
