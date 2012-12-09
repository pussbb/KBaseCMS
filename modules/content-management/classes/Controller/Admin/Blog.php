<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Admin_Blog extends Controller_Template_Admin {

    public function action_index()
    {
      if ($this->request->is_ajax())
        $this->render_partial();
    }

    public function action_categories()
    {
        if ($this->request->is_ajax())
            $this->render_partial();
    }

    public function action_articles()
    {
        if ($this->request->is_ajax())
            $this->render_partial();
    }
}
