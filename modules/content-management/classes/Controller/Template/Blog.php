<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Template_Blog extends Controller_Core {

    protected  $check_access = FALSE;
    protected  $layout = 'blog/2columns';

    public function before()
    {
        parent::before();
        Media::bundle('blog');
    }
}
