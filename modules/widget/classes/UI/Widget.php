<?php defined('SYSPATH') or die('No direct script access.');

class UI_Widget extends UI {

  public function _render()
  {
    return View::factory('ui/widget', $this->params)->render();
  }
}
