<?php defined('SYSPATH') or die('No direct script access.');
$categories = Model_Blog_Category::find_all();

echo Helper_Actions::action(new Model_Blog_Category, 'new', array('class' => 'btn btn-primary'));
$categories = Collection::build_tree($categories->records);

function print_tree($collection)
{
    echo '<ol>';
    foreach($collection as $key => $category) {
        echo '<li class="can_remove">';
        $object = $category['object'];;
        echo $object->name. Helper_Actions::destroy($object);
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
        echo $object->name. Helper_Actions::destroy($object);
        $childs = Arr::get($category, 'childs');
        if ($childs)
        {
            print_tree($childs, $key);
        }
        echo '</li>';
    }
echo '</ul>';
