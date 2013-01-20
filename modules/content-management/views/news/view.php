<?php defined('SYSPATH') or die('No direct script access.');

echo '<section class="post">';

    echo '<header>';
        echo '<h1>';
            echo HTML::anchor('news/view/'.$news->id,$news->title);
        echo '<i class="icon-file pull-right"></i>';
        echo '</h1>';
        echo '<blockquote><small>';
            echo '<strong><i class="icon-calendar"></i></strong>&nbsp;';
            echo Date::format($news->created_at);
            echo '&nbsp;|&nbsp;';
            echo '<strong><i class="icon-user"></i></strong>&nbsp;';
            echo $news->author->login;
        echo '</small></blockquote>';
    echo '</header>';

    echo '<article>';
        echo $news->content;
    echo '</article>';

    echo '<footer>';
            echo '<hr class="grey">';
    echo '</footer>';

echo '</section>';
