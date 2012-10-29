<?php defined('SYSPATH') or die('No direct script access.');
echo '<div class="widget-box">';
  echo '<div class="widget-title">';
    if (isset($icon))
        echo '<span class="icon">'.$icon.'</span>';
    if (isset($title))
        echo '<h5>'.$title.'</h5>';
    echo '</div>';
    echo '<div class="widget-content nopadding">';
      echo isset($content)?$content:'';
    echo '</div>';
echo '</div>';