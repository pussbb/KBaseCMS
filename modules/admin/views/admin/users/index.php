<?php defined('SYSPATH') or die('No direct script access.');

echo  UI_Table::render(array(
    'model'=>'user',
    'columns' => array('id', 'login', 'email'),
    'actions' => array('destroy', 'view'),
));
