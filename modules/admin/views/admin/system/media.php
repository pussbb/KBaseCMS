<?php defined('SYSPATH') or die('No direct script access.');

$bunles = Kohana::$config->load('media');
$core = $bunles['core'];
unset($bunles['core']);

$media_path = Arr::get($core, 'path');
echo tr('Media file list by bundle');

echo '<ul>';
foreach($bunles as $bundle => $files) {
    echo '<li>';
        echo $bundle;
        foreach($files as $type => $collection) {
            if( ! is_array($collection))
                continue;
            echo '<ol>';
                foreach($collection as $name => $attr) {
                    if( is_numeric($name) && ! Arr::is_array($attr))
                        $name = $attr;
                    $exists = TRUE;
                    if (strpos('static://', $name) === TRUE || Valid::url($name)) {
                        echo "<li>Static resource: $name</li>";
                    }
                    else {
                        echo "<li>$name.$type &mdash; ";
                        if ( ! file_exists($media_path.$type.DIRECTORY_SEPARATOR.$name.".$type"))
                            echo "Not exists";
                        else 
                            echo "Exists";
                    }
                }
            echo '</ol>';
        }
    echo '</li>';
}
echo '</ul>';
