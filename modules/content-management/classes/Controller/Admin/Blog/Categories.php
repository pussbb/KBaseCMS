<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Admin_Blog_Categories extends Controller_Template_Admin {

    public function action_index()
    {
        $this->set_filename('admin/blog/categories');
        if ($this->request->is_ajax())
            $this->render_partial();
    }

    public function action_new()
    {
        $this->model = new Model_Blog_Category;
        $this->set_filename('admin/blog_categories/form');
        if ($this->request->is_ajax())
            $this->render_partial();
    }


    public function action_edit()
    {
        $this->model = Model_Blog_Category::find($this->request->param('id'));
        $this->set_filename('admin/blog_categories/form');
        if ($this->request->is_ajax())
            $this->render_partial();
    }

    public function action_update()
    {
        $this->model = new Model_Blog_Category;
        foreach(array('name','description', 'parent_id') as $field){
            $this->model->$field = Arr::get($_REQUEST, $field);
        }
        $id = Arr::get($_REQUEST, 'id');
        if ($id)
        {
            $this->model->id = $id;
        }

        if ( ! $this->model->save() ) {

            if ($this->request->is_ajax())
                return $this->render_partial('admin/blog_categories/form');
            else
                return $this->set_filename('admin/blog_categories/form');

        }
        $this->render_nothing();
    }

    public function action_destroy()
    {
        if ( ! $this->is_delete())
            throw new HTTP_Exception_403(tr('Access deny'));

        Model_Blog_Category::destroy(array(
            'id' => $this->request->param('id'),
            '|| parent_id' => $this->request->param('id')
        ));
        $this->render_nothing();
    }
}
