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

 class Helper_Admin_Modules_Blog {

  public static function info()
  {
    return array(
      'name' => tr('Blog'),
      'description' => tr('some description'),
      'icon' => '<i class="icon-edit"></i>',
      'uri' => 'blog/'
    );
  }

  public static function menu_items()
  {
    return array(
        'categories' => array(
            'title' => tr('Categories'),
            'uri' => 'blog/categories/',
        ),
        'articles' => array(
            'title' => tr('Articles'),
            'uri' => 'blog/articles/',
        ),
    );
  }
 }
