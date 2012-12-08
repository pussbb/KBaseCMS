<?php defined('SYSPATH') or die('No direct script access.');
$categories = Model_Blog_Category::find_all();

echo Helper_Actions::action(new Model_Blog_Category, 'new', array('class' => 'btn btn-primary'));
echo '<ul>';
    foreach($categories->records as $category) {
        echo '<li class="can_remove">';
        echo $category->name. Helper_Actions::destroy($category);
        echo '</li>';
    }
echo '</ul>';
