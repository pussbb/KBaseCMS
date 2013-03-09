<?php defined('SYSPATH') or die('No direct script access.');

echo Helper_Actions::action(new Model_Blog_Post, 'new', array('class' => 'btn btn-primary'));
echo '<br/><br/>';
echo  UI_Table::render(array(
    'model'=> 'blog_post',
    'columns' => array('id', 'uri', 'created_at', 'author.login', 'category.name'),
    'titles' => array(
        tr('id'),
        tr('uri'),
        tr('created_at'),
        tr('author'),
        tr('category'),
    ),
    'actions' => array('destroy',  'edit',  ),
    'filter' => array('with' => array('contents', 'author', 'category')),
));
