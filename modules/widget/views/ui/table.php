<?php defined('SYSPATH') or die('No direct script access.');
$sort_field = $order[0];
$sort_dir = $order[1];

echo '<table class="table table-bordered data-table">';
    echo '<thead>';
      echo '<tr>';
      foreach($titles as $index => $title) {
          echo '<th>';
            echo $title;
            echo '<span class="sort">';
                $large_icon = '';
                if ($index === $sort_field && $sort_dir === 'ASC')
                    $large_icon = 'icon-large';
                echo HTML::anchor(
                    '#',
                    "<i class=\"icon-angle-up $large_icon\"></i>",
                    array(
                        'title' => 'Sort ASC',
                        'rel' => 'tooltip',
                        'data-sort' => json_encode(array($sort_key => $index, $sort_dir_key => 'ASC'))
                    )
                );
                $large_icon = '';
                if ($index === $sort_field && $sort_dir === 'DESC')
                    $large_icon = 'icon-large';
                echo HTML::anchor(
                    '#',
                    "<i class=\"icon-angle-down $large_icon\"></i>",
                    array(
                        'title' => 'Sort DESC',
                        'rel' => 'tooltip',
                        'data-sort' => json_encode(array($sort_key => $index, $sort_dir_key => 'DESC'))
                    )
                );
            echo '</span>';
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
        echo '<tr class="form-inline">';
            echo '<td colspan="50" class="text-center" >';
                echo '<span class="text-left">';
                    echo tr('Total: ');
                    echo $total;
                echo '</span>';
                echo str_repeat('&nbsp;', 10);
                echo Form::label($limit_key, tr('Per page: '), array('class' => 'control-label'));
                echo Form::select(
                    $limit_key,
                    array(10 => 10,20 => 20,50 => 50,100 => 100),
                    $limit,
                    array('class' => 'input-mini limit', )
                );

                echo str_repeat('&nbsp;', 10);
                $pages = array();
                for($i = 1; $i <= ceil($total/$limit); $i++)
                {
                    $pages[] = $i;
                }

                echo Form::label($offset_key, tr('Page: '), array('class' => 'control-label'));
                echo Form::select(
                    $offset_key,
                    $pages ,
                    $offset,
                    array('class' => 'offset input-mini')
                );

            echo '</td>';
        echo '</tr>';
    echo '</tfoot>';

echo '</table>';
