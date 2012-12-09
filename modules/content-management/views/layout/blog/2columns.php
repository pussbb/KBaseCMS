<?php defined('SYSPATH') or die('No direct script access.');?>
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
        $categories = Model_Blog_Category::find_all();
        //debug(Collection::build_tree($categories), true);
        echo '<h3>'.tr('Categories').'</h3>';
        $categories = Collection::build_tree($categories->records);

        function print_tree($collection)
        {
            echo '<ol>';
            foreach($collection as $key => $category) {
                echo '<li class="can_remove">';
                $object = $category['object'];;
                echo HTML::anchor(URL::site('blog/categories/index/'.$object->id), $object->name);
                $childs = Arr::get($category, 'childs');
                if ($childs)
                {
                    print_tree($childs, $key);
                }
                echo '</li>';
            }
            echo '</ol>';
        }

        echo '<ul>';
            foreach($categories as $key => $category) {
                echo '<li class="can_remove">';
                $object = $category['object'];
                echo HTML::anchor(URL::site('blog/categories/index/'.$object->id), $object->name);

                $childs = Arr::get($category, 'childs');
                if ($childs)
                {
                    print_tree($childs, $key);
                }
                echo '</li>';
            }
        echo '</ul>';

    ?>
  </div>
</div>
