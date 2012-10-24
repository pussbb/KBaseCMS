<?php
define('DOCROOT', realpath(dirname(__FILE__)).DIRECTORY_SEPARATOR);

function reduce_slashes($str)
{
    return preg_replace('#(?<!:)//+#', '/', $str);
}

function subdirs($dir)
{
    $files = scandir($dir);
    array_shift($files);    // remove '.' from array
    array_shift($files);    // remove '..' from array
    $result = array();
    foreach ($files as $file) {
        $file = reduce_slashes($dir . DIRECTORY_SEPARATOR . $file);
        if (is_dir($file)) {
            $result[] = $file;
        }
    }
    return $result;
}

function to_rfc($dir)
{
    $files = scandir($dir);
    array_shift($files);    // remove '.' from array
    array_shift($files);    // remove '..' from array

    foreach ($files as $file) {
        $file = reduce_slashes($dir . DIRECTORY_SEPARATOR . $file);
        $name = pathinfo($file, PATHINFO_BASENAME);
        if ((bool)preg_match( '/^[A-Z]/', $name))
            continue;

        $new_file = $dir . DIRECTORY_SEPARATOR . ucfirst($name);
        rename($file, $new_file);
        if (is_dir($new_file))
            to_rfc($new_file);
    }
}

function migrate($dir)
{
    $classes_dir = reduce_slashes($dir . DIRECTORY_SEPARATOR . 'classes'.DIRECTORY_SEPARATOR);
    if ( file_exists($classes_dir) && is_dir($classes_dir)) {
        to_rfc($classes_dir);
        return ;
    }

    foreach(subdirs($dir) as $subdir)
    {
        $classes_dir = reduce_slashes($subdir . DIRECTORY_SEPARATOR . 'classes'.DIRECTORY_SEPARATOR);
        if ( file_exists($classes_dir) && is_dir($classes_dir)) {
            to_rfc($classes_dir);
        }
        else {
            migrate($subdir);
        }
    }
}

foreach(array('application', 'modules') as $folder) {
    migrate(DOCROOT.$folder);
}

