<?php defined('SYSPATH') or die('No direct script access.');

class Controller_News extends Controller_Core {

    protected $check_access = FALSE;

    public function action_index()
    {

        $this->limit = Arr::get($_REQUEST, 'limit', 1);
        $this->offset = Arr::get($_REQUEST, 'page');

        $this->news_items = Model_News::find_all(
            array('with'=>'author', 'total_count' => TRUE),
            $this->limit,
            $this->offset
        );

    }

    public function action_view()
    {
        $this->news = Model_News::find($this->request->param('id'));
    }
}
