<?php defined('SYSPATH') or die('No direct script access.');

echo '<section class="post">';
    echo '<header>';
        echo '<h1>';
            echo $article->title;
        echo '<i class="icon-file pull-right"></i>';
        echo '</h1>';
    echo '</header>';

    echo '<article>';
        echo $article->content;
    echo '</article>';

    echo View::factory('blog/post/footer', array('post' => $article));
echo '</section>';

echo View::factory('blog/comments/form',
    array('model' => new Model_Blog_Post_Comment(array('post_id' => $article->id)))
);

echo View::factory('blog/comments/collection', array('post' => $article));
