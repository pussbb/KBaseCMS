<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Welcome extends Controller_Core {

    protected  $check_access = FALSE;

    public function action_index()
    {
        $this->append_js_template('sdfsdf', 'dfgfdgfdg');
    }

} // End Welcome
