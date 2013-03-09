<?php defined('SYSPATH') or die('No direct script access.');

echo Helper_Actions::action(new Model_Blog_Post, 'new', array('class' => 'btn btn-primary'));
echo '<br/><br/>';
echo  UI_Table::render(array(
    'model'=> 'blog_post',
    'columns' => array(
        'id' => array(),
        'uri' => array(
            'callback' => function($x){
                return HTML::anchor('article/'.$x, $x, array('target' => '_blank'));
            },
            'class' => 'text-left'
        ),
        'created_at' => array(),
        'author.login' => array(),
        'category.name' => array()
    ),
    'titles' => array(
        tr('id'),
        tr('URI'),
        tr('Created at'),
        tr('Author'),
        tr('Category'),
    ),
    'actions' => array('destroy',  'edit',  ),
    'filter' => array('with' => array('contents', 'author', 'category')),
));
