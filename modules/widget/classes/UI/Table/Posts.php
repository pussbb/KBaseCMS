<?php defined('SYSPATH') or die('No direct script access.');

class UI_Table_Posts extends UI {

  private function view_data()
  {
    $model = $this->model;
    $limit_key = $model::module_name().'_limit';
    $offset_key = $model ::module_name().'_offset';

    $records = $model::find_all(array(
                        'limit' => Arr::get($_REQUEST, $limit_key, $this->param('limit', $this->model->per_page)),
                        'offset' => Arr::get($_REQUEST, $offset_key, $this->param('offset')),
                        'total_count' => TRUE,
                        'with' => array('author', 'contents'),
                    ));
    $labels = $this->model->labels();
    $labels['author'] = Model_User::table_labels();

    return array(
        'titles' => Arr::extract($labels, $this->param('columns')),
        'columns' => $this->param('columns'),
        'records' => $records->records,
        'total' => $records->count,
        'per_page' => $records->per_page,
        'actions' => $this->param('actions', array())
    );
  }

  public function _render()
  {
    return View::factory('ui/table', $this->view_data())->render();
  }
}
