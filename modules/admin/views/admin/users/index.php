<?php defined('SYSPATH') or die('No direct script access.');
ob_start();
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

$content = ob_get_contents();
ob_end_clean();
echo UI_Widget::render(array('title' => 'Users', 'content' => $content));