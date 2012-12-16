<?php defined('SYSPATH') or die('No direct script access.');
foreach($articles as $post)
{
    echo HTML::anchor(URL::site('article/'.$post->uri));
    echo $post->uri.'<br>';

}
