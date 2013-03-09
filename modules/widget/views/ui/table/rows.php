<?php defined('SYSPATH') or die('No direct script access.');

foreach($records as $record) {
    echo '<tr>';
        $is_assoc = Arr::is_assoc($columns);
        foreach($columns as $column => $attr) {
            if ( ! $is_assoc) {
                $column = $attr;
                $attr = array();
            }
            $parts = explode('.', $column);
            $content = Collection::property($record, $column);
            if (count($parts) > 1) {
                $content = $record;
                foreach($parts as $part) {
                    $content = Collection::property($content, $part);
                }
            }
            $callback = Arr::get($attr, 'callback');
            if ($callback) {
                $content = call_user_func($callback, $content);
                unset($attr['callback']);
            }
            $attrs = HTML::attributes($attr);
            echo "<td $attrs>$content</td>";
        }
        if($actions)
        {
            echo '<td>';
            foreach($actions as $action) {
                echo Helper_Actions::action($record, $action);
            }
            echo '</td>';
        }
    echo '</tr>';
}
