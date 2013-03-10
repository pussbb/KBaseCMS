<?php defined('SYSPATH') or die('No direct script access.');

echo Helper_Actions::action(new Model_Blog_Post, 'new', array('class' => 'btn btn-primary'));
echo '<br/><br/>';
echo  UI_Table::render(array(
    'model'=> 'blog_post',
    'columns' => array(
        'id' => array(
            'title' => tr('id')
        ),
        'uri' => array(
            'callback' => function($x){
                return HTML::anchor('article/'.$x, $x, array('target' => '_blank'));
            },
            'class' => 'text-left',
            'title' => tr('URI')
        ),
        'created_at' => array(
            'title' => tr('Created at')
        ),
        'author.login' => array(
            'title' => tr('Author')
        ),
        'category.name' => array(
            'title' => tr('Category')
        )
    ),
    'actions' => array('destroy',  'edit',  ),
    'filter' => array('with' => array('contents', 'author', 'category')),
));
