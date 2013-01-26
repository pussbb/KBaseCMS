<?php defined('SYSPATH') or die('No direct script access.');



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

$uri = Request::current()->uri();

$count = ($offset*$limit)+count($news_items->records);
echo '<nav>';
        if ($count < $news_items->count) {
            if (!isset($_REQUEST['limit']))
                $limit = NULL;
            echo HTML::anchor(
                $uri.URL::query(array('page' => $offset+1, 'limit' => $limit)),
                tr('Previous news'),
                array('class' => 'read-more btn btn-inverse btn-small')
            );
        }

        if ($offset && --$offset >= 0) {

            if ($offset == 0)
                $offset = NULL;
            if (!isset($_REQUEST['limit']))
                $limit = NULL;

            echo HTML::anchor(
                $uri.URL::query(array('page' => $offset, 'limit' => $limit)),
                tr('Next news'),
                array('class' => 'read-more btn btn-inverse btn-small pull-right')
            );
        }
echo '</nav>';
