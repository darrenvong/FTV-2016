<?php include "header.php"; ?>

<div class="spacer"></div>

  <?php
    $featured_img = $page->featured_image->url;
  ?>

  <meta name="twitter:description" content="<?php echo trimExcerpt($page->excerpt); ?>">

    <section id="title">
      <div id="bg_img" style="background-image:url(<?php echo $featured_img; ?>)"></div>
      <div id="bg"></div>
      <div id="full-height">
        <h2><?php echo $page->title; ?></h2>
        <h3>Published <?php echo $page->post_date; ?> | In <?php displayCats($page); ?></h3>
      </div>
    </section>

    <article>
      <a href="<?= $config->urls->root; ?>"><span id="back"><I class="fa fa-arrow-circle-left"></i> Home</span></a>
      <?= $page->content; ?>

      <?php
        // Find the next video in the same category
        $related = $pages->findOne("parent=$page->parent, id!=$page->id, sort=-post_date");

        if ($related->id !== 0):
      ?>

        <div class="blog-tile">
          <h4>Watch next <i class="fa fa-play"></i></h4>
          <h3><?php echo $related->title; ?></h3>
          <a href="<?php echo $related->url; ?>">
            <div class="cover"></div>
          </a>
        </div>

      <?php
        endif;
        //Disqus comments here
        // comments_template( $file, $separate_comments );
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

    <a id="more" href="$pages->get('/videos/')->url"><span><I class="fa fa-arrow-circle-right"></i> More videos</span></a>

<?php
  include_once "contact.php";
  include_once "footer.php";
?>
