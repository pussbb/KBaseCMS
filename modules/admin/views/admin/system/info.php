<?php defined('SYSPATH') or die('No direct script access.');

echo  tr('Mode:').' ';
switch ( Kohana::$environment) {
    case Kohana::PRODUCTION : echo tr('Production');break;
    case Kohana::STAGING: tr('Staging'); break;
    case Kohana::TESTING: tr('Testing'); break;;
    default: echo tr('Development'); break;
}

echo '<p>';
    echo tr('Coffeescript compiler').':';
    try {
        Tools_Coffeescript::check();
        echo tr('Installed');
    }
    catch(Exception $e){ 
        echo tr('Not Installed');
    }
echo '</p>';

echo '<p>';
    echo tr('Less compiler').':';
    try {
        Tools_Less::check();
        echo tr('Installed');
    }
    catch(Exception $e){ 
        echo tr('Not Installed');
    }
echo '</p>';

echo 'PHP info';
echo '<pre>';
ob_start();
phpinfo();
$info = ob_get_contents();
ob_end_clean();
echo preg_replace('/[body,a:link] {(.*)}\n/','',  $info);
echo '</pre>';
