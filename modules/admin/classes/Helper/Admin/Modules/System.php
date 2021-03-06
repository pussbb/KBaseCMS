<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Module
 * @package blog
 * @copyright 2012 pussbb@gmail.com
 * @license http://www.gnu.org/copyleft/gpl.html GNU GENERAL PUBLIC LICENSE v3
 * @version 0.1.2
 * @link https://github.com/pussbb/Kohana-my-base
 * @category extra
 * @subpackage extra
 */

 class Helper_Admin_Modules_System {

  public static function info()
  {
    return array(
      'name' => tr('System'),
      'description' => tr('some description'),
      'icon' => '<i class="icon-cogs"></i>',
      'uri' => 'system/'
    );
  }

  public static function menu_items()
  {
    return array(
        'general' => array(
            'title' => tr('General Info'),
            'uri' => 'system/info/',
        ),
        'categories' => array(
            'title' => tr('Media'),
            'uri' => 'system/media/',
        ),

    );
  }
 }
