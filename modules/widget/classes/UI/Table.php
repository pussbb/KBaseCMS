<?php defined('SYSPATH') or die('No direct script access.');

class UI_Table extends UI {

  public function __construct(array $params)
  {
      parent::__construct($params);
      if ( ! is_object($this->model) && ! $this->model instanceof Base_Model)
        throw new Kohana_Exception('Not valid model');
  }

  private function view_data()
  {
    $model = $this->model;
    $limit_key = $model::module_name().'_limit';
    $offset_key = $model ::module_name().'_offset';

    $records = $model::find_all(array(
                        'limit' => Arr::get($_REQUEST, $limit_key, $this->param('limit', $this->model->per_page)),
                        'offset' => Arr::get($_REQUEST, $offset_key, $this->param('offset')),
                        'total_count' => TRUE,
                    ));

    return array(
        'titles' => Arr::extract($this->model->labels(), $this->param('columns')),
        'columns' => $this->param('columns'),
        'records' => $records->records,
        'total' => $records->count,
        'actions' => $this->param('actions', array())
    );
  }

  public function _render()
  {
    return View::factory('ui/table', $this->view_data())->render();
  }
}