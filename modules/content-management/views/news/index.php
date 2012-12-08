<?php defined('SYSPATH') or die('No direct script access.');
$news_items = Model_News::find_all(array('with'=>'author'), 20);

foreach($news_items->records as $news_item){
    echo View::factory('news/view', array('news' => $news_item))->render();
}
