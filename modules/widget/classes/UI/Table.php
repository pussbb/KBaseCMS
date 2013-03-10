<?php defined('SYSPATH') or die('No direct script access.');

class UI_Table extends UI {

    private $data = array();

    public function __construct(array $params)
    {
        parent::__construct($params);
        $this->model = new $this->model;

//         var_dump($this->model->order());

        $titles = array();
        $columns = $this->param('columns');

        if ( ! Arr::is_assoc($columns))
            $titles = Arr::extract($this->model->labels(), $columns);
        else
            $titles = array_combine(array_keys($columns), Arr::path($columns, '*.title'));

        $this->data = array(
            'columns' => $columns,
            'records' => array(),
            'total' => 0,
            'per_page' => 0,
            'titles' => $titles,
            'collection_view' => 'ui/table/rows',
            'limit_key' => $this->request_param_name('limit'),
            'offset_key' => $this->request_param_name('offset'),
            'limit' => $this->limit(),
            'offset' => $this->offset(),
            'actions' => $this->param('actions', array()),
            'sort_key' => $this->request_param_name('sort_field'),
            'sort_dir_key' => $this->request_param_name('sort_dir'),

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

    public function sort()
    {
        $order_field = $this->request_param('sort_field');
        $order_dir = $this->request_param('sort_dir');
        if ( ! array_key_exists($order_field, Arr::get($this->data, 'titles', array()))
            || ! in_array($order_dir, array('ASC', 'DESC')))
            return $this->model->order();
        return array($order_field, $order_dir);
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
            'order_by' => $this->sort(),
        ), $this->param('filter', array()));

        $records = $model::find_all($filter);

        return Arr::merge(
            $this->data,
            array(
                'records' => $records->records,
                'order' => $this->sort(),
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
