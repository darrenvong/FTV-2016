<?php
  $theme_path = $config->paths->templates . "FTV-2016/";
  if ($page->template->name === "home") {
    include_once $theme_path . "front-page.php";
    
  }
  elseif ($page->template->name === "video" || $page->template->name === "live") {
    if ($page->upcoming_live) include_once $theme_path . "single-live.php";
    else include_once $theme_path . "single-vid.php";
  }
  elseif ($page->template->name === "blog") {
    include_once $theme_path . "single-blog.php";
  }
  elseif ($page->template->name === "category") {
    include_once $theme_path . "category.php";
  }
  elseif ($page->template->name === "hire") {
    include_once $theme_path . "page-hire.php";
  }
  elseif ($page->template->name === "search") {
    include_once $theme_path . "search.php";
  }
  elseif ($page->template->name === "gallery") {
    include_once $theme_path . "gallery.php";
  }

