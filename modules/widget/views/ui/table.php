<?php defined('SYSPATH') or die('No direct script access.');

echo '<table class="table table-bordered data-table">';
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

        if ( ! $records)
        {
            echo '<tr class="alert alert-info">';
                echo '<td COLSPAN="'.(count($columns)+1).'">';
                    echo tr('Nothing to display');
                echo '</td>';
            echo '</tr>';
        }
        else
        {
            echo View::factory($collection_view, get_defined_vars());
        }
    echo '</tbody>';
    echo '<tfoot>';
        $colspan = floor((count($columns)+1)/2);
        echo '<tr class="form-inline">';
            echo '<td colspan="'.$colspan.'" class="text-left" >';
                echo Form::label($limit_key, tr('Per page: '), array('class' => 'control-label'));
                echo Form::select(
                    $limit_key,
                    array(10 => 10,20 => 20,50 => 50,100 => 100),
                    $limit,
                    array('class' => 'input-mini limit', )
                );
            echo '</td>';

            $pages = array();
            for($i = 1; $i <= ceil($total/$limit); $i++)
            {
                $pages[] = $i;
            }
            echo '<td colspan="'.$colspan.'" class="text-left">';
                echo Form::label($offset_key, tr('Page: '), array('class' => 'control-label'));
                echo Form::select($offset_key, $pages , $offset);
            echo '</td>';
        echo '</tr>';
    echo '</tfoot>';

echo '</table>';
