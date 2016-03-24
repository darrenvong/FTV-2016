<?php
/* Template Name: Hire Us */
get_header(); ?>

<div class="spacer"></div>

<?php
if ( have_posts() ) {
	while ( have_posts() ) {
		the_post();

    $featured_img = wp_get_attachment_url( get_post_thumbnail_id($post->ID) );
    ?>

      <section class="page_img">
        <div id="bg_img" style="background-image:url(<?php echo $featured_img; ?>)"></div>
        <div id="bg"></div>
        <div class="featured-info">

          <h4><a id="whiteeeeee" href="http://localhost/wp"><span id="404-back"><I class="fa fa-arrow-circle-left"></i> Home</span></a></h4>
          <h2><?php the_title(); ?></h2>
          <p>Forge TV can be hired for event coverage, music videos and pretty much anything else you can imagine.</p>
          <a href="#demo"><button id="watch-now">Watch demo reel <i class="fa fa-play"></i></button></a>
        </div>
      </section>

      <section class="page_strip" id="demo">
        <?php the_content(); ?>
        <div class="content-right">
          <h4>Support student television</h4>
          <h3>Trained operators</h3>
          <p>We take hires seriously, and only supply fully-trained members. The proceeds go toward new equipment and resources for Forge TV, so we can keep training the media professionals of the future.</p>
        </div>
      </section>

      <section class="page_img" >
        <div id="bg_img" style="background-image:url(<?php bloginfo('template_directory'); ?>/img/hire.jpg)"></div>
        <div id="bg"></div>
        <div class="featured-info" id="centred">
          <h3>Professional equipment</h3>
          <p>We use a mixture of high-definition DSLRs and camcorders to capture events, and have access to a range of industry-standard broadcasting equipment.</p>
        </div>
      </section>

      <section class="page_strip" id="demo">


        <div class="hire-tile-container">
          <div class="hire-tile">
            <i class="fa fa-calendar fa-2x"></i>
            <h5>Event highlights</h5>
            <p>We'll come along to your event, be it a fair, lecture, ball or gig, and shoot highlights.</p>
            <h4>From £50</h4>
          </div>
          <div class="hire-tile">
            <i class="fa fa-music fa-2x"></i>
            <h5>Music videos</h5>
            <p>Making the visuals to go with your next single is our specialty.</p>
            <h4>From £120</h4>
          </div>
          <div class="hire-tile">
            <i class="fa fa-video-camera fa-2x"></i>
            <h5>Live streams</h5>
            <p>Filled your venue? Why not add value to your event with a recording, public or private live stream.</p>
            <h4>From £80</h4>
          </div>
        </div>

        <div class="content-right">
          <h4>Support student television</h4>
          <h3>Affordable packages</h3>
          <p>We'll work with you to create a custom filming package that fits your needs and your budget.</p>
        </div>

      </section>










      <?php
    } // end while
  }; // end if

get_template_part(contact);
get_footer();
?>
