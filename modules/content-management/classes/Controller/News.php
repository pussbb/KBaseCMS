<?php defined('SYSPATH') or die('No direct script access.');

class Controller_News extends Controller_Core {

    protected $check_access = FALSE;

    public function action_index()
    {
    }

    public function action_view()
    {
        $this->news = Model_News::find($this->request->param('id'));
    }
}
