<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Admin_News extends Controller_Template_Admin {

    public function action_index()
    {
    }

    public function action_new()
    {
        $this->model = new Model_News();
        $this->set_filename('admin/news/form');
    }

    public function action_edit()
    {
        $this->model = Model_News::find($this->request->param('id'));
        $this->set_filename('admin/news/form');
    }

    public function action_update()
    {
        $this->model = new Model_News();
        foreach(array('title','content', 'link') as $field){
            $this->model->$field = Arr::get($_REQUEST, $field);
        }


        $id = Arr::get($_REQUEST, 'id');
        if ($id) {
            $this->model->id = $id;
        }
        else {
            $this->model->author_id = Auth::instance()->current_user()->id;
            $this->model->created_at = strtotime('now');
        }

        if ( ! $this->model->save()) {
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

    public function action_details()
    {
        $this->news = Model_News::find($this->request->param('id'));
        return $this->set_filename('admin/news/details');
    }
} // End Welcome
