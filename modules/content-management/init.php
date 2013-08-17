<?php defined('SYSPATH') OR die('No direct access allowed.');

$uri_check_codes = Base_Language::uri_check_codes();

Route::set('blog', '(<lang>)(/)blog(/<controller>)(/<action>(/<id>))', array(
        'id' => '[a-zA-Z0-9_/]+',
        'lang' => $uri_check_codes,
  ))->defaults(array(
   'directory' => 'blog',
   'controller' => 'welcome',
   'action'     => 'index',
));

Route::set('archive_blog', '(<lang>)(/)blog/<year>(/<month>)', array(
        'year' => '\d{4}',
        'month' => '\d{1,2}',
        'lang' => $uri_check_codes,
  ))->defaults(array(
   'directory' => 'blog',
   'controller' => 'archive',
   'action'     => 'index',
));


Route::set('post', '(<lang>)(/)article/<id>', array(
        'id' => '[a-zA-Z0-9_/]+',
        'lang' => $uri_check_codes,
  ))->defaults(array(
   'directory' => 'blog',
   'controller' => 'post',
   'action'     => 'index',
));

Route::set('page', '(<lang>)(/)<id>', array(
    'id' => '([\w]+\-[\w]+)+',
    'lang' => $uri_check_codes
  ))->defaults(array(
   'controller' => 'page',
   'action'     => 'index',
));

Admin_Modules::instance()->register('pages', realpath(__FILE__).DIRECTORY_SEPARATOR);
Admin_Modules::instance()->register('blog', realpath(__FILE__).DIRECTORY_SEPARATOR);
Admin_Modules::instance()->register('news', realpath(__FILE__).DIRECTORY_SEPARATOR);
