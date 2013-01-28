<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Blog_Welcome extends Controller_Template_Blog {

    public function action_index()
    {
        $this->articles = Helper_Blog::recent();
        $this->set_filename('blog/articles_collection');
        $this->set_title(tr('Welcome to our Blog'));
    }

} // End Welcome
