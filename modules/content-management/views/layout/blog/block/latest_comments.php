<?php defined('SYSPATH') or die('No direct script access.');

echo '<section>';
    echo '<header>';
        echo '<h1>';
            echo tr('Latest Comment');
            echo '<i class="icon-bookmark pull-right"></i>';
        echo '</h1>';
    echo '</header>';
    $comments = Model_Blog_Post_Comment::find_all(array(
        'width' => array('post', 'author')
    ), 3);
    foreach($comments->records as $comment)
    {
        echo '<article class="recent">';
            echo '<p>';
                echo HTML::anchor('article/'.$comment->post->uri,$comment->post->title);
            echo '</p>';
            echo '<p class="post-date">'.Date::format($comment->created_at).'</p>';
            echo Text::truncate($comment->content, 150, '');
            echo HTML::anchor(
                'article/'.$post->uri,
                tr('Read more')
            );
        echo '</article>';
        echo '<hr class="dotted">';
    }
echo '</section>';
