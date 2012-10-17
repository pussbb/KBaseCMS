<?php defined('SYSPATH') or die('No direct script access.');
?>
<div class="row-fluid">
  <div class="span9"><?php echo $content;?></div>
  <div class="span3">
      <form class="form-search">
        <div class="input-append">
          <input type="text" class="span8 search-query">
          <button type="submit" class="btn">Search</button>
        </div>
      </form>
    <?php
        $categories = Model_Blog_Category::find_all()->records;
        ///debug(Collection::build_tree($categories, 'id', 2), true);
        echo '<h3>'.tr('Categories').'</h3>';
        echo '<ul>';
          foreach($categories as $category) {
              echo '<li>'.HTML::anchor('blog/category/'.$category->id, $category->name, array(
                  'title' => $category->description,
              )).'</li>';
          }
        echo '</ul>';
    ?>
  </div>
</div>