<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Admin_Welcome extends Controller_Template_Admin {

    public function action_index()
    {

    }

    public function action_clean_cache()
    {
        Dir::rmdir(Kohana::$cache_dir, FALSE);
        return $this->render_nothing();
    }

    public function action_logs()
    {
        $this->file = $this->request->param('id');
        if ($this->request->is_ajax())
            $this->render_partial();
    }
}
