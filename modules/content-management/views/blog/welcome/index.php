<?php defined('SYSPATH') or die('No direct script access.');

foreach(Helper_Blog::recent() as $post)
{
    echo HTML::anchor(URL::site('article/'.$post->uri));
    echo $post->uri.'<br>';

}
