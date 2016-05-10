<?php
  if (in_category('committee-blog')) {
    get_template_part('single-blog');
  } else if (in_category('upcoming-live')) {
    get_template_part('single-live');
  }else{
    get_template_part('single-vid');
  };
?>
