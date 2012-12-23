<?php defined('SYSPATH') or die('No direct script access.');
?>

<div class="btn-group">
  <a class="btn dropdown-toggle btn-primary" data-toggle="dropdown" href="#">
    Create Page
    <span class="caret"></span>
  </a>
  <ul class="dropdown-menu">
    <li>
        <?php
            echo HTML::anchor(
                URL::site('admin/pages/new?type=file'),
                '<i class="icon-magic"></i> '.tr('AS single file'),
                array(
                    'rel' => 'tooltip',
                    'class' => 'action action_new',
                    'data-original-titl' => tr('Add new page')
                )
            );
        ?>
    </li>
    <li>
        <?php
            echo HTML::anchor(
                URL::site('admin/pages/new?type=folder'),
                '<i class="icon-magic"></i>'.tr('As Folder'),
                array(
                    'rel' => 'tooltip',
                    'class' => 'action action_new',
                    'data-original-titl' => tr('Add new page')
                )
            );
        ?>
    </li>
  </ul>
</div>
<?php

$modules = array_merge(array('application' => APPPATH), Kohana::modules());
$pages = array();
foreach($modules as $module)
{
    $view_path = $module.'views'.DIRECTORY_SEPARATOR.'pages'.DIRECTORY_SEPARATOR;
    foreach(Dir::listing($view_path) as $dir_item)
    {
        $item = pathinfo($dir_item, PATHINFO_FILENAME);
        if (isset($pages[$item]))
            continue;
        $type = 'file';
        $langs = array();
        if (is_dir($dir_item)){
            $type = 'folder';
            $langs = array_map(function($x){ return pathinfo($x, PATHINFO_FILENAME);},Dir::listing($dir_item));
        }
        $pages[$item] = array(
            'type' => $type,
            'langs' => $langs
        );
    }
}

echo '<ul>';
    foreach($pages as $page => $attr) {
        echo '<li class="can_remove">';
            $type = $attr['type'];
            echo HTML::anchor(URL::site($page), $page, array('target' => '_blank'));
            echo HTML::anchor(
                URL::site("admin/pages/destroy?type=$type&page=$page"),
                '<i class="icon-trash"></i> '. tr('Delete') .'&nbsp;',
                array(
                    'data-title' => tr('Delete %s', array('page '.$page)),
                    'data-toggle'=>'confirm',
                    'title' => tr('Delete %s', array('page '.$page)),
                    'rel' => 'tooltip',
                    'class' => 'action action_destroy'
                )
            );

            echo HTML::anchor(
                URL::site("admin/pages/edit?type=$type&page=$page"),
                '<i class="icon-pencil"></i> '. tr('Edit') .'&nbsp;',
                array(
                    'title' => tr('Edit %s', array('page '.$page)),
                    'rel' => 'tooltip',
                    'class' => 'action action_edit'
                )
            );
        echo '</li>';
    }
echo '</ul>';
