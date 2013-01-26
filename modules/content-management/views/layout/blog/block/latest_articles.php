<?php defined('SYSPATH') or die('No direct script access.');

echo '<section>';

    echo '<header>';
        echo '<h1>';
            echo tr('Latest Artciles');
            echo '<i class="icon-bookmark pull-right"></i>';
        echo '</h1>';
    echo '</header>';
    $articles = Helper_Blog::recent(3);
    foreach($articles as $post)
    {
        echo '<article class="recent">';
            echo '<p>';
                echo HTML::anchor('article/'.$post->uri,$post->title);
            echo '</p>';
            echo '<p class="post-date">'.Date::format($post->created_at).'</p>';
            echo Text::truncate($post->brief, 150, '');
            echo HTML::anchor(
                'article/'.$post->uri,
                tr('Read more').' →'
            );
        echo '</article>';
        echo '<hr class="dotted">';
    }
echo '</section>';
