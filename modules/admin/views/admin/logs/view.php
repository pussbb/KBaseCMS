<?php defined('SYSPATH') or die('No direct script access.');

echo '<pre>';
echo file_get_contents(APPPATH.'logs'.DIRECTORY_SEPARATOR.str_replace('-', DIRECTORY_SEPARATOR, $file).'.php');
echo '</pre>';
