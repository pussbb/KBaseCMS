<?php defined('SYSPATH') or die('No direct script access.');

abstract class UI {

  protected $params = NULL;

  public function __construct(array $params)
  {
      $this->params = $params;
  }

  public static function render(array $params = array())
  {
      $klass = get_called_class();
      $ui =  new $klass($params);
      return $ui->_render();
  }

  abstract protected function _render();
}