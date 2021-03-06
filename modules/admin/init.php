<?php defined('SYSPATH') or die('No direct script access.');

Route::set('admin', '(<lang>)(/)admin(/<controller>)(/<action>(/<id>))', array(
  'lang' => Base_Language::uri_check_codes(),
  ))
    ->defaults(array(
        'directory' => 'admin',
        'lang' => NULL,
        'controller' => 'welcome',
        'action'     => 'index',
    ));

Admin_Modules::instance()->register('users', realpath(__FILE__).DIRECTORY_SEPARATOR);
Admin_Modules::instance()->register('system', realpath(__FILE__).DIRECTORY_SEPARATOR);
