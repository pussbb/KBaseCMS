<?php defined('SYSPATH') or die('No direct script access.');

$news_items = Model_News::find_all(array('with'=>'author'), 20);

echo '<h3>'.tr('Latest news').'</h3>';
echo '<hr class="double">';

foreach($news_items->records as $news_item) {

    $read_more = '<br>'.HTML::anchor(
        Helper_Model::url($news_item, 'view'),
        tr('Read more'),
        array('class' => 'read-more btn btn-inverse btn-small')
    );

    $news_item->content = Text::truncate($news_item->content, 500, $read_more);
    echo View::factory('news/view', array('news' => $news_item))->render();

}
