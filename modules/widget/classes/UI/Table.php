<?php defined('SYSPATH') or die('No direct script access.');

class UI_Table extends UI {

    private $data = NULL;

    public function __construct(array $params)
    {
        parent::__construct($params);
        $this->data = array(
            'columns' => $this->param('columns'),
            'records' => array(),
            'total' => 0,
            'per_page' => 0,
            'titles' => array(),
            'collection_view' => 'ui/table/rows',
            'actions' => $this->param('actions', array())
        );
    }

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

    public function data()
    {
        $model = $this->model;
        $filter = Arr::merge(array(
            'limit' => $this->limit(),
            'offset' => $this->offset(),
            'total_count' => TRUE,
        ), $this->param('filter', array()));

        $records = $model::find_all($filter);
        $model = new $model;
        $titles = $this->param('titles');
        if ( ! $titles)
            $titles = Arr::extract($model->labels(), $this->param('columns'));

        return Arr::merge(
            $this->data,
            array(
                'titles' => $titles,
                'records' => $records->records,
                'total' => $records->count,
                'per_page' => $records->per_page,
            )
        );
  }

  public function _render()
  {
    return View::factory('ui/table', $this->data())->render();
  }

}
