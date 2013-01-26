<?php defined('SYSPATH') or die('No direct script access.');

echo '<footer>';
        echo '<strong><i class="icon-calendar"></i></strong>&nbsp;';
        echo Date::format($post->created_at);
        echo '&nbsp;|&nbsp;';
        echo '<strong><i class="icon-user"></i></strong>&nbsp;';
        echo $post->author->login;
        echo '&nbsp;|&nbsp;';
        echo '<strong><i class="icon-list"></i></strong>&nbsp;';
        echo HTML::anchor(URL::site('blog/categories/index/'.$post->category->id), $post->category->name );
        echo '&nbsp;|&nbsp;';
        echo  '<strong><i class="icon-comments"></i></strong>&nbsp;';
        echo tr('%d Comments', array($post->total_comments));
        echo '<hr class="grey">';
echo '</footer>';
