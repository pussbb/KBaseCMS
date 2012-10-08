<?php defined('SYSPATH') OR die('No direct access allowed.');

Route::set('blog', '(<lang>)(/)blog(/<controller>)(/<action>(/<id>))', array(
        'id' => '[a-zA-Z0-9_/]+',
        'lang' => Language::uri_check_codes(),
  ))->defaults(array(
   'directory' => 'blog',
   'controller' => 'welcome',
   'action'     => 'index',
));

Route::set('post', '(<lang>)(/)article/<id>.html', array(
        'id' => '[a-zA-Z0-9_/]+',
        'lang' => Language::uri_check_codes(),
  ))->defaults(array(
   'directory' => 'blog',
   'controller' => 'post',
   'action'     => 'index',
));

Route::set('page', '(<lang>)(/)<id>', array(
    'id' => '([\w]+\-[\w]+)+',
    'lang' => Language::uri_check_codes()
  ))->defaults(array(
   'controller' => 'page',
   'action'     => 'index',
));
