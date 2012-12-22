<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Admin_System extends Controller_Template_Admin {

    public function action_index()
    {
        if ($this->request->is_ajax())
            $this->render_partial();
    }

    public function action_info()
    {
        if ($this->request->is_ajax())
            $this->render_partial();
    }

    public function action_media()
    {
        if ($this->request->is_ajax())
            $this->render_partial();
    }

}
