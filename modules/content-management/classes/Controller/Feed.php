<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Feed extends Controller {

    public function action_rss()
    {
        $this->feed = Feed::factory('rss/2.0');
    }

    public function after()
    {
        $this->response
            ->headers('Content-Type', $this->feed->mime_type())
            ->body($this->feed->render());
    }
}
