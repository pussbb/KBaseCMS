<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Welcome extends Controller_Core {

    protected  $check_access = FALSE;

    public function action_index()
    {
    }

    public function action_about_us()
    {
        $this->render_nothing();
    }

    public function action_contact()
    {
        $this->render_partial();
    }

} // End Welcome
