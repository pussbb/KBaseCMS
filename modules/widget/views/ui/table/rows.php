<?php defined('SYSPATH') or die('No direct script access.');

foreach($records as $record) {
    echo '<tr>';
        foreach($columns as $column) {
            $parts = explode('.', $column);
            $content = Collection::property($record, $column);
            if (count($parts) > 1) {
                $content = $record;
                foreach($parts as $part) {
                    $content = Collection::property($content, $part);
                }
            }
            echo "<td>$content</td>";
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
