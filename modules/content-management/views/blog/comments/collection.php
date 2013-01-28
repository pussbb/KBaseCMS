<?php defined('SYSPATH') or die('No direct script access.');

$comments = $post->comments(array('with' => 'author'));

if ( ! $comments)
    return;

foreach($comments as $comment){
}
echo '<section>';
    echo '<header>';
        echo '<h2>';
            echo tr('Latest Comments');
        echo '</h2>';
    echo '</header>';

    foreach($post->comments as $comment)
    {
        echo '<article class="recent">';
            echo '<p class="post-date">';
                echo Date::format($comment->created_at);
                echo '&nbsp;|&nbsp;';
                echo '<strong><i class="icon-user"></i></strong>&nbsp;';
                echo $comment->author->login;
            echo '</p>';
            echo $comment->content;
        echo '</article>';
        echo '<hr class="dotted">';
    }
echo '</section>';
