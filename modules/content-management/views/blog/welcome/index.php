<?php defined('SYSPATH') or die('No direct script access.');

foreach(Helper_Blog::recent() as $post)
{
    echo '<section class="post">';
        echo '<header>';
            echo '<h1>';
                echo HTML::anchor('article/'.$post->uri, $post->title);
            echo '<i class="icon-file pull-right"></i>';
            echo '</h1>';
            echo '<blockquote><small>';
                echo '<strong><i class="icon-calendar"></i></strong>&nbsp;';
                echo Date::format($post->created_at);
                echo '&nbsp;|&nbsp;';
                echo '<strong><i class="icon-user"></i></strong>&nbsp;';
                echo $post->author->login;
            echo '</small></blockquote>';
        echo '</header>';

        echo '<article>';
            echo $post->brief;
            echo '<br>'.HTML::anchor(
                'article/'.$post->uri,
                tr('Read more'),
                array('class' => 'read-more btn btn-inverse btn-small')
            );
        echo '</article>';

        echo '<footer>';
                echo '<hr class="grey">';
        echo '</footer>';

    echo '</section>';
}
