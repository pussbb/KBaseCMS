<?php defined('SYSPATH') or die('No direct script access.');

echo '<section>';
    echo '<header>';
        echo '<h1>';
            echo tr('Archives');
            echo '<i class="icon-bookmark pull-right"></i>';
        echo '</h1>';
    echo '</header>';
    $dates = Model_Blog_Post::select_query('created_at')->execute()->as_array();
    $dates = Arr::pluck($dates, 'created_at');
    $tree = array();
    foreach($dates as $date) {
        $time = strtotime($date);
        $year = date('Y', $time);
        $month = date('m', $time);
        if (!isset($tree[$year]))
            $tree[$year][$month] = 1;
        else
            $tree[$year][$month] = ++$tree[$year][$month];
    }

    arsort($tree);
    echo '<ul class="recent archive-list">';
    foreach($tree as $year => $months) {
        echo '<li>';
            echo '<i class="icon-caret-right"></i>';
            echo HTML::anchor(URL::site('/blog/'.$year), $year);
            echo '<ol class="hidden">';
                foreach($months as $month => $count) {
                    echo '<li>';
                    echo '<i class="icon-caret-right"></i>';
                    echo HTML::anchor(URL::site('/blog/'.$year.'/'.$month), Text::month_name($month)." ($count)");
                    echo '</li>';
                }
            echo '</ol>';
        echo '</li>';

    }
    echo '</ul>';

echo '</section>';
