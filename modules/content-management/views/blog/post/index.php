<?php defined('SYSPATH') or die('No direct script access.');

echo '<section class="post">';
    echo '<header>';
        echo '<h1>';
            echo $article->title;
        echo '<i class="icon-file pull-right"></i>';
        echo '</h1>';
        echo '<blockquote><small>';
            echo '<strong><i class="icon-calendar"></i></strong>&nbsp;';
            echo Date::format($article->created_at);
            echo '&nbsp;|&nbsp;';
            echo '<strong><i class="icon-user"></i></strong>&nbsp;';
            echo $article->author->login;
        echo '</small></blockquote>';
    echo '</header>';

    echo '<article>';
        echo $article->content;
    echo '</article>';

    echo '<footer>';
            echo '<hr class="grey">';
    echo '</footer>';

echo '</section>';
