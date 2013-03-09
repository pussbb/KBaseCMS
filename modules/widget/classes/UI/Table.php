<?php defined('SYSPATH') or die('No direct script access.');

class UI_Table extends UI {

    private $data = NULL;

    public function __construct(array $params)
    {
        parent::__construct($params);
        $this->model = new $this->model;
        $this->data = array(
            'columns' => $this->param('columns'),
            'records' => array(),
            'total' => 0,
            'per_page' => 0,
            'titles' => array(),
            'collection_view' => 'ui/table/rows',
            'limit_key' => $this->request_param_name('limit'),
            'offset_key' => $this->request_param_name('offset'),
            'limit' => $this->limit(),
            'offset' => $this->offset(),
            'actions' => $this->param('actions', array())
        );
    }

    private function request_param_name($key)
    {
        return strtolower(call_user_func(array($this->model, 'module_name')).'_'.$key);
    }

    private function request_param($key)
    {
        return Arr::path($_REQUEST, $this->request_param_name($key), $this->param($key));
    }

    public function limit()
    {
        $value = $this->request_param('limit');
        return (int) $value === 0 ? $this->model->per_page : $value;
    }

    public function offset()
    {
        return (int)$this->request_param('offset');
    }

    public function data()
    {
        $model = $this->model;
        $limit = $this->limit();
        $offset = $this->offset();
        if ($offset > 0)
            $offset = $offset*$limit;

        $filter = Arr::merge(array(
            'limit' => $limit ,
            'offset' => $offset,
            'total_count' => TRUE,
        ), $this->param('filter', array()));

        $records = $model::find_all($filter);

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
