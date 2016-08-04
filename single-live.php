<?php include $config->paths->templates . "FTV-2016/header.php"; ?>

<div class="spacer"></div>

  <?php
    $featured_img = $page->featured_image->url;
  ?>

  <meta name="twitter:description" content="<?php echo trimExcerpt($page->excerpt); ?>">

    <section id="title">
      <div id="bg_img" style="background-image:url(<?php echo $featured_img; ?>)"></div>
      <div id="bg"></div>
      <div id="full-height">
        <h2>Live: <?= $page->title; ?></h2>
        <h3>Published <?= $page->post_date; ?> | In <?php displayCats($page); ?></h3>
      </div>
    </section>

    <article>
      <a href="http://forgetoday.com/tv"><span id="back"><I class="fa fa-arrow-circle-left"></i> Home</span></a>

    <section class="live-container">
      <div class="autosizer">
      <script src="http:////content.jwplatform.com/players/idJNvXsO-i9raT3mC.js"></script>
      </div>

      <a class="twitter-timeline" href="https://twitter.com/ForgeTV" data-widget-id="713860130178265088" data-chrome="transparent noheader nofooter">Tweets by @ForgeTV</a>
      <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+"://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
    </section>

    <span class="mobile-player">Not working? Try the <a href="http://195.195.131.195:1935/redirect/ForgeTV/forgecast?scheme=m3u8">mobile player</a>.</span>

      <?php echo $page->content; ?>

      <div style="margin-bottom:20px;"></div>

      <?php // Disqud comments here
        //comments_template( $file, $separate_comments );
      ?>
  </article>


  <h4 class="related"><?php randomText(); ?></h4>
  <section class="related">

    <?php
    $page_cats = getCategories($page);
    $related_posts = $pages->find("parent=$page_cats, sort=random, limit=4, id!=$page->id");

    foreach ($related_posts as $related):

      $featured_img = $related->featured_image->url;
    ?>

    <div class="padder">
      <div class="related-tile">

        <div class="related-image" style="background-image:url(<?php echo $featured_img; ?>)">
        </div>
        <div class="related-content">
          <h4><?= $related->post_date; ?></h4>
          <h3><?= $related->title; ?></h3>
        </div>

        <a href="<?= $related->url; ?>"><div class="cover"></div></a>

        <div class="grad"></div>

      </div>
    </div>
    <?php endforeach; ?>

  </section>

    <a id="more" href="http://forgetoday.com/tv/videos"><span><I class="fa fa-arrow-circle-right"></i> More videos</span></a>


<?php
  include_once $config->paths->templates . "FTV-2016/contact.php";
  include_once $config->paths->templates . "FTV-2016/footer.php";
?>
