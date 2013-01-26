<?php defined('SYSPATH') or die('No direct script access.');

foreach($articles as $post)
{
    echo '<section class="post">';
        echo '<header>';
            echo '<h1>';
                echo HTML::anchor('article/'.$post->uri,$post->title);
            echo '<i class="icon-file pull-right"></i>';
            echo '</h1>';
        echo '</header>';

        echo '<article>';
            echo $post->brief;
            echo '<br>'.HTML::anchor(
                'article/'.$post->uri,
                tr('Read more'),
                array('class' => 'read-more btn btn-inverse btn-small')
            );
        echo '</article>';
        echo View::factory('blog/post/footer', array('post' => $post));
    echo '</section>';
}


echo '<nav>';
    echo Helper_Blog::previous_posts();
    echo Helper_Blog::next_posts();
echo '</nav>';
