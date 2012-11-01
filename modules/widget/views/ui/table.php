<?php defined('SYSPATH') or die('No direct script access.');

echo '<table class="table table-bordered">';
    echo '<thead>';
      echo '<tr>';
      foreach($titles as $title) {
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
                    echo '<td>'.$record->$column.'</td>';
                }
                if($actions)
                {
                  echo '<td>';
                    foreach($actions as $action) {
                        echo HTML::anchor(Helper_Model::url($record, $action), $action);
                    }
                  echo '</td>';
                }
            echo '</tr>';
        }
    echo '</tbody>';
echo '</table>';
