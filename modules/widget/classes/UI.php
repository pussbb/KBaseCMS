<?php defined('SYSPATH') or die('No direct script access.');

abstract class UI {

  protected $params = NULL;

  protected $model = NULL;

  public function __construct(array $params)
  {
      $this->params = $params;
      $this->model = Helper_Model::class_name(Arr::get($params, 'model'));
  }

  protected function param($key, $default = NULL)
  {
    return Arr::path($this->params, $key, $default);
  }

  private function new_model($name)
  {
    $model = Helper_Model::class_name($name);
    return new $model();
  }

  public static function render(array $params = array())
  {
      $klass = get_called_class();
      $ui =  new $klass($params);
      return $ui->_render();
  }

  abstract protected function _render();
}
