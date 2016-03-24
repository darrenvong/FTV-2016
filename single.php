<?php
  if (in_category(5)){
    get_template_part('single-blog');
  }else{
    get_template_part('single-vid');
  };
?>
