<?php
  
  /**
   * Displays a navigation menu "page"
   * @param $id - the specified CSS id value for the <ul> element of the menu
   * @param $menu - the menu Page (a ProcessWire object) to display
   */
  function display_menu($menu, $page, $pages, $id = "") {
    echo "<div class='menu-" . $menu->name . "-container'>";
    echo "<ul id='$id'>";
    foreach ($menu->menu_item as $menu_item) {
      if ($pages->get($menu_item->menu_item_link)->id === $page->id) {
        echo "<li class='active'><a href='$menu_item->menu_item_link'>" .
            "$menu_item->menu_field</a></li>";
      }
      else
        echo "<li><a href='$menu_item->menu_item_link'>" .
          "$menu_item->menu_field</a></li>";
    }
    echo "</ul></div>";
  }

  /** Picks a hero photo name at random. */
  function displayRandom() {
      $NUM_HERO_PHOTOS = 5;
      for ($i = 1; $i <= $NUM_HERO_PHOTOS; $i++) {
        $photoAreas[] = "/hero" . $i . ".jpg";
      }
      $randomNumber = rand(0, (count($photoAreas) - 1));
      echo $photoAreas[$randomNumber];
  }

  /** Randomise the text on the "More to see" section. Used in a single post template. */
  function randomText() {
      $seeMoreText = array("Always more to see", "More delightful videos", "Lots left to see", "We've got lots left to show you", "Aren't you glad to see us", "Have a looksie", "Fancy seeing you here");
      $randomNumber = rand(0, (count($seeMoreText) - 1));
      echo $seeMoreText[$randomNumber];
  }

  /**
   * Trims the excerpt text into the specified length.
   * @param $text - the excerpt text to trim
   * @param $length - the first x number of words to retain. Default is 15.
   */
  function trimExcerpt($text, $length = 15) {
    //The "16th word" will be the rest of the sentence, hence $length + 1
    $words = explode(' ', $text, $length + 1);
    if (count($words) > $length) {
      array_pop($words);
      array_push($words, "...");
      $text = implode(' ', $words);
    }

    return $text;
  }

  /**
   * Fetches the assigned categories to the page.
   * @param $page - the page to search for the categories.
   * @return the $page's categories as a PageArray.
   */
  function getCategories($page) {
    $prime_cat = $page->parent; //Page object
    $secondary_cats = $page->other_cats; //PageArray object

    //Prepend therefore adds prime_cat page into secondary_cats array
    return $secondary_cats->prepend($prime_cat);
  }

  /**
   * Output a category list for the post.
   * @param $page - the page to search for the categories.
   */
  function displayCats($page) {
    $cats_output = "<ul class='post-categories'>";

    $categories = getCategories($page);
    foreach ($categories as $category) {
      $cats_output .= "<li><a href='$category->url'>$category->title</a></li>";
    }

    $cats_output .= "</ul>";

    echo $cats_output;
  }

  /**
   * Build the selector required to find related posts (i.e. posts that are in
   * the same categories as the current page/post)
   * @param $page - the current post/page
   * @param $categories - the categories the page are under
   * @return the selector as a string to be used for $posts->find(...) PW
   * API function.
   */
  function buildRelatedCatSelector($page, $categories) {
    $related_selector = "parent=";
    $first_item = true;
    foreach ($categories as $category) {
      if ($first_item) {
        $related_selector .= "$category->id";
        $first_item = false;
      }
      else {
        $related_selector .= "|$category->id";
      }
    }

    return $related_selector;
  }

