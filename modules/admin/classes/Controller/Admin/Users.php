<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Admin_Users extends Controller_Template_Admin {

    public function action_index()
    {
      if ($this->request->is_ajax())
        $this->render_partial();
    }

}