<?php defined('SYSPATH') or die('No direct script access.');

echo '<table class="table">';
    echo '<thead>';
      echo '<tr>';
      foreach(array('Id', 'Login', 'Email') as $field) {
          echo '<th>';
          echo $field;
          echo '</th>';
      }
      echo '</tr>';
    echo '</thead>';
    echo '<tbody>';
    foreach(Model_User::find_all()->records as $user) {
        echo '<tr>';
            echo '<td>'.$user->id.'</td>';
            echo '<td>'.$user->login.'</td>';
            echo '<td>'.$user->email.'</td>';
        echo '</tr>';
    }
    echo '</tbody>';
echo '</table>';