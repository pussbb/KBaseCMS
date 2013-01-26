<?php defined('SYSPATH') or die('No direct script access.');?>
<div class="row-fluid">
  <div class="span9"><?php echo $content;?></div>
  <div class="span3 sidebar">
      <!--<form class="form-search">
        <div class="input-append">
          <input type="text" class="span8 search-query">
          <button type="submit" class="btn btn-inverse ">Search</button>
        </div>
      </form>-->
    <?php
        echo View::factory('layout/blog/block/categories');
        echo View::factory('layout/blog/block/latest_articles');
        echo View::factory('layout/blog/block/latest_comments');
    ?>
  </div>
</div>
