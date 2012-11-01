<?php defined('SYSPATH') or die('No direct script access.');

abstract class UI {

  protected $params = NULL;

  protected $model = NULL;

  public function __construct(array $params)
  {
      $this->params = $params;
      $model = Arr::get($params, 'model');
      if ($model)
      {
        if ( ! $model instanceof Base_Model)
            $this->model = $this->new_model($model);
        else
            $this->model = $model;
      }
  }

  protected function param($key, $default = NULL)
  {
    return Arr::path($this->params, $key, $default);
  }

  private function new_model($name)
  {
        if (! (bool)preg_match('/[Mm]odel/', $name))
        {
            $parts = explode('_', $name);
            array_unshift($parts, 'model');
            $name = implode('_', array_filter(array_map('ucfirst', $parts)));
        }
        return new $name;
  }

  public static function render(array $params = array())
  {
      $klass = get_called_class();
      $ui =  new $klass($params);
      return $ui->_render();
  }

  abstract protected function _render();
}