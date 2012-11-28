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
}
