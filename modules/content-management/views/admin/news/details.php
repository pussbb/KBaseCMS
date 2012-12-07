<?php defined('SYSPATH') or die('No direct script access.');

echo '<h3>'.$news->title.'</h3>';
echo tr('Publish date:').$news->created_at;
echo '<p>';
    echo $news->content;
echo '</p>';
