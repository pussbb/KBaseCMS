<?php defined('SYSPATH') or die('No direct script access.');

echo '<h3>'.$news->title.'</h3>';
echo '<hr>';
echo tr('Publish date:').$news->created_at;
echo '<hr>';
echo '<p>';
    echo $news->link.'<br>';
    echo $news->content;
echo '</p>';
