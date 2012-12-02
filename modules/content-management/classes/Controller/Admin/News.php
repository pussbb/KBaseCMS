<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Admin_News extends Controller_Template_Admin {

    public function action_index()
    {
      if ($this->request->is_ajax())
        $this->render_partial();
    }

    public function action_new()
    {
        $this->model = new Model_News();
        if ($this->request->is_ajax())
            $this->render_partial('admin/news/form');
        else
            $this->set_filename('admin/news/form');
    }

    public function action_update()
    {
        $this->model = new Model_News();
        foreach(array('title','content') as $field){
            $this->model->$field = Arr::get($_REQUEST, $field);
        }
        $this->model->author_id = 0;//Auth::instance()->current_user()->id;
        $this->model->created_at = strtotime('now');
        if ( ! $this->model->save()) {debug($this->model);

            if ($this->request->is_ajax())
                return $this->render_partial('admin/news/form');
            else
                return $this->set_filename('admin/news/form');

        }
        $this->render_nothing();
    }

    public function action_destroy()
    {
        if ( ! $this->is_delete())
            throw new HTTP_Exception_403(tr('Access deny'));

        Model_News::destroy($this->request->param('id'));
        $this->render_nothing();
    }
} // End Welcome
