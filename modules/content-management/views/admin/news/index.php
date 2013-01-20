<?php defined('SYSPATH') or die('No direct script access.');

echo Helper_Actions::action(new Model_News(), 'new', array('class' => 'btn btn-primary'));
echo '<br/><br/>';
echo  UI_Table::render(array(
    'model'=> 'news',
    'columns' => array('id', 'title', 'created_at'),
    'actions' => array('destroy', 'edit' , 'view'),
));
