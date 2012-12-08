<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Feed extends Controller {

    public function action_rss()
    {
        $feed = Feed::factory();
        $this->response
            ->headers('Content-Type', $feed->mime_type())
            ->body($feed->render());
    }

}
