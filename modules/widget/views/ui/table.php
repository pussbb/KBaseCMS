<?php defined('SYSPATH') or die('No direct script access.');

echo '<table class="table table-bordered">';
    echo '<thead>';
      echo '<tr>';
      foreach(Arr::flatten($titles) as $title) {
          echo '<th>';
            echo $title;
          echo '</th>';
      }
      if ($actions)
      {
        echo '<th>';
          echo tr('Actions');
        echo '</th>';
      }
      echo '</tr>';
    echo '</thead>';
    echo '<tbody>';
        foreach($records as $record) {
            echo '<tr>';
                foreach($columns as $column) {
                    echo '<td>'.Collection::property($record, $column).'</td>';
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
        if ( ! $records)
        {
            echo '<tr class="alert alert-info">';
                echo '<td COLSPAN="'.(count($columns)+1).'">';
                    echo tr('Nothing to display');
                echo '</td>';
            echo '</tr>';
        }
    echo '</tbody>';
    echo '<tfoot>';
        echo '<tr>';
          echo '<td colspan="40">'.tr('Per page: ').$per_page.'</td>';
        echo '</tr>';
    echo '</tfoot>';

echo '</table>';
