<?php defined('SYSPATH') or die('No direct script access.');

class UI_Table extends UI {

//     public function __construct(array $params)
//     {
//
//     }

    private function request_param($key)
    {
        $name = call_user_func(array($this->model, 'module_name')).'_'.$key;
        return Arr::get($_REQUEST, $name, $this->param($key));
    }

    public function limit()
    {
        $value = $this->request_param('limit');
        return $value === 0 ? NULL : $value;
    }

    public function offset()
    {
        return $this->request_param('offset');
    }

    private function simple()
    {
        $model = $this->model;
        $records = $model::find_all(array(
            'limit' => $this->limit(),
            'offset' => $this->offset(),
            'total_count' => TRUE,
        ));
        $model = new $model;
        return array(
            'titles' => Arr::extract($model->labels(), $this->param('columns')),
            'columns' => $this->param('columns'),
            'records' => $records->records,
            'total' => $records->count,
            'per_page' => $records->per_page,
            'actions' => $this->param('actions', array())
        );
  }

  public function _render()
  {
    return View::factory('ui/table', $this->simple())->render();
  }
}
