<?php defined('SYSPATH') or die('No direct script access.');

echo Helper_Actions::action(new Model_Blog_Post, 'new', array('class' => 'btn btn-primary'));
echo '<br/><br/>';
echo  UI_Table::render(array(
    'model'=> 'blog_post',
    'columns' => array('id', 'title', 'created_at'),
    'actions' => array('destroy', 'view'),
));
