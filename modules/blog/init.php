<?php defined('SYSPATH') OR die('No direct access allowed.');

Route::set('blog', '(<lang>)(/)blog(/<controller>)(/<action>(/<id>))')
  ->defaults(array(
   'directory' => 'blog',
   'controller' => 'welcome',
   'action'     => 'index',
));

Route::set('post', '(<lang>)(/)article/<id>.html', array('id' => '[a-zA-Z0-9_/]+'))
  ->defaults(array(
   'directory' => 'blog',
   'controller' => 'post',
   'action'     => 'index',
));

Route::set('page', '(<lang>)(/)<id>', array('id' => '([\w]+\-[\w]+)+'))
  ->defaults(array(
   'directory' => 'blog',
   'controller' => 'page',
   'action'     => 'index',
));
