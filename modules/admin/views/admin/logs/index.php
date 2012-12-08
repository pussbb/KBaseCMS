<?php defined('SYSPATH') or die('No direct script access.');

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
echo '<ul>';
    foreach($result as $file) {
        echo '<li class="can_remove">';
            echo HTML::anchor(URL::site('admin/logs/view/'.$file), $file, array('class' => 'action_details'));
            echo HTML::anchor(URL::site('admin/logs/destroy/'.$file), ' | <i class="icon-trash"></i> ',
            array(
                'data-title' => tr('Delete %s', array('log file')),
                'data-toggle'=>'confirm',
                'rel'=>"tooltip",
                'title' => tr('Delete %s', array('log file'))
            ));
        echo '</li>';
    }
echo '</ul>';
