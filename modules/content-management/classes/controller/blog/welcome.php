<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Blog_Welcome extends Controller_Core {

    protected  $check_access = FALSE;

    public function before()
    {
      parent::before();
      $this->set_layout('blog/2columns');
    }
    public function action_index()
    {

    }

} // End Welcome
