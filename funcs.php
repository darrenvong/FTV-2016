<?php
  
  /**
   * Displays a navigation menu "page"
   * @param $id - the specified CSS id value for the <ul> element of the menu
   * @param $menu - the menu Page (a ProcessWire object) to display
   */
  function display_menu($menu, $id = "") {
    echo "<div class='menu-" . $menu->name . "-container'>";
    echo "<ul id='$id'>";
    foreach ($menu->menu_item as $menu_item) {
      echo "<li><a href='$menu_item->menu_item_link'>$menu_item->menu_field</a></li>";
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
?>
