<?php defined('SYSPATH') OR die('No direct access allowed.');

Route::set('blog', '(<lang>)(/)blog(/<controller>)(/<action>(/<id>))', array(
        'id' => '[a-zA-Z0-9_/]+',
        'lang' => Language::uri_check_codes(),
  ))->defaults(array(
   'directory' => 'blog',
   'controller' => 'welcome',
   'action'     => 'index',
));

Route::set('post', '(<lang>)(/)article/<id>', array(
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

Admin_Modules::instance()->register('blog', realpath(__FILE__).DIRECTORY_SEPARATOR);
Admin_Modules::instance()->register('news', realpath(__FILE__).DIRECTORY_SEPARATOR);
