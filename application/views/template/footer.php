<?php defined('SYSPATH') or die('No direct script access.');
$site_name = Kohana::$config->load('site.title');
echo '<br>';
echo '<p align="center">';
    echo 'Copyright ©'.date('Y').'&nbsp;'.$site_name.'&nbsp;.';
    echo tr('All Rights Reserved.');
echo '</p>';
