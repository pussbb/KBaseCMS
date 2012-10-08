<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Blog_Post extends Controller_Core {

    protected  $check_access = FALSE;

    public function action_index()
    {
        debug($this->request->param('id'), true);
    }

} // End Welcome
