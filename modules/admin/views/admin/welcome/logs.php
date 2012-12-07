<?php defined('SYSPATH') or die('No direct script access.');

if ($file)
{
    echo '<pre>';
    echo file_get_contents(APPPATH.'logs'.DIRECTORY_SEPARATOR.str_replace('-', DIRECTORY_SEPARATOR, $file).'.php');
    echo '</pre>';
    return;
}

$files = Dir::files(APPPATH.'logs');
$result = array();
foreach($files as $file)
{
    $ok = (bool)preg_match('/(\d{1,4})\/(\d{1,2})\/(\d{1,2}).php/', $file, $matches);
    if ($ok) {
        unset($matches[0]);
        $result[] = implode('-', $matches);
    }

}
echo '<ul class="tree">';
    foreach($result as $file) {
        echo '<li>';
            echo HTML::anchor(URL::site('admin/welcome/logs/'.$file), $file, array('class' => 'action_details'));
        echo '</li>';
    }
echo '</ul>';
