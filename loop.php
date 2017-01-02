<?php
/**
  * Post Loop template for the Forge Modern template, mainly to be used in conjunction with SiteOrigin page builder loop widget.
  *
  * @author Darren Vong
  * @version 1.0
  */
  
  if ( have_posts() ):
?>
  <style type="text/css">
  #forge-tv-grid{display:-webkit-box;display:-webkit-flex;display:-ms-flexbox;display:flex;-webkit-flex-flow:row wrap;-ms-flex-flow:row wrap;flex-flow:row wrap;position:relative;padding:10px 5px;width:100%;-webkit-box-sizing:border-box;box-sizing:border-box}@media only screen and (max-width: 900px){#forge-tv-grid{height:auto}}#forge-tv-grid .forge-tv-padder{width:30%;padding:10px}@media only screen and (max-width: 900px){#forge-tv-grid .forge-tv-padder{width:50%}}@media only screen and (max-width: 600px){#forge-tv-grid .forge-tv-padder{width:100%}}#forge-tv-grid .forge-tv-tile{border:1px solid #dfdfdf;height:330px;-webkit-box-shadow:0px 0px 5px rgba(0,0,0,0.1);box-shadow:0px 0px 5px rgba(0,0,0,0.1);-webkit-transition:.2s;transition:.2s;position:relative;overflow:hidden}#forge-tv-grid .forge-tv-tile .forge-tv-cover{position:absolute;top:0;right:0;left:0;bottom:0}#forge-tv-grid .forge-tv-tile .forge-tv-tile-image{height:50%;background-size:cover;background-position:center;-webkit-filter:brightness(.8)}#forge-tv-grid .forge-tv-tile .forge-tv-tile-info{height:50%;padding:20px;position:relative}#forge-tv-grid .forge-tv-tile .forge-tv-tile-info .forge-tv-triangle{width:0;height:0;border-left:25px solid transparent;border-right:25px solid transparent;border-bottom:30px solid #fafafa;position:absolute;top:-25px;left:15px}#forge-tv-grid .forge-tv-tile .forge-tv-tile-info p{font-size:.8em;color:#969696;margin-top:10px}#forge-tv-grid .forge-tv-tile .forge-tv-tile-info h2{text-transform:uppercase;color:#282961;font-size:1.3em}#forge-tv-grid .forge-tv-tile .forge-tv-tile-info ul{list-style:none;z-index:10;position:relative;padding:0;margin-bottom:5px}#forge-tv-grid .forge-tv-tile .forge-tv-tile-info ul li{display:inline;margin-right:5px;font-size:.8em;font-family:open sans,sans-serif}#forge-tv-grid .forge-tv-tile .forge-tv-tile-info ul li a{color:#969696;font-weight:100}#forge-tv-grid .forge-tv-tile .forge-tv-tile-info ul li a:before{content:none}#forge-tv-grid .forge-tv-tile:hover{-webkit-transform:scale(1.01, 1.01);-ms-transform:scale(1.01, 1.01);transform:scale(1.01, 1.01);-webkit-transition:.2s;transition:.2s}#forge-tv-grid .forge-tv-tile:hover .forge-tv-tile-info{background:-webkit-linear-gradient(top, rgba(255,255,255,0) 0%, rgba(40,41,97,0.05) 100%);background:-webkit-gradient(linear, left top, left bottom, from(rgba(255,255,255,0)), to(rgba(40,41,97,0.05)));background:linear-gradient(to bottom, rgba(255,255,255,0) 0%, rgba(40,41,97,0.05) 100%);filter:progid:DXImageTransform.Microsoft.gradient( startColorstr='#00ffffff', endColorstr='#1a282961',GradientType=0 )}.forge-tv-grad{position:absolute;z-index:4;bottom:0;height:40px;left:0;width:100%;background:rgba(255,255,255,0);background:-webkit-gradient(left top, left bottom, color-stop(0%, rgba(255,255,255,0)), color-stop(47%, rgba(246,246,246,0.47)), color-stop(100%, #fafafa));background:-webkit-linear-gradient(top, rgba(255,255,255,0) 0%, rgba(246,246,246,0.47) 47%, #fafafa 100%);background:-webkit-gradient(linear, left top, left bottom, from(rgba(255,255,255,0)), color-stop(47%, rgba(246,246,246,0.47)), to(#fafafa));background:linear-gradient(to bottom, rgba(255,255,255,0) 0%, rgba(246,246,246,0.47) 47%, #fafafa 100%);filter:progid:DXImageTransform.Microsoft.gradient( startColorstr='#ffffff', endColorstr='$background-color', GradientType=0 )}

  </style>
  <section id="forge-tv-grid">
<?php while ( have_posts() ):
        the_post();
        $thumbnail_size = array(768, 432); //"HD" thumbnail size
?>
    
    <div class="forge-tv-padder">
      <div class="forge-tv-tile">
        <div class="forge-tv-tile-image" style="background-image:url(<?php echo the_post_thumbnail_url( $thumbnail_size ); ?>)">
        </div>
        <div class="forge-tv-tile-info">
          <div class="forge-tv-triangle"></div>
          <h4><?php the_category(); ?></h4>
          <h2>
            <?php if (in_category("upcoming-live")): ?>
                    <i class="forge-tv-fa fa-rss"></i>
            <?php endif; ?>
            <?php the_title(); ?>
          </h2>
          <p><?php the_excerpt(); ?></p>
          <div class="forge-tv-grad"></div>
        </div>
        <a href="<?php the_permalink(); ?>">
        <div class="forge-tv-cover"></div>
        </a>
      </div>
    </div>

  <?php endwhile; ?>
  </section>
<?php else: ?>
    <p>
      <?php _e( 'No posts found. Check back again later!', 'framework' ); ?>
    </p>
<?php endif; ?>
