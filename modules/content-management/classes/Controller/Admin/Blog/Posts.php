<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Admin_Blog_Posts extends Controller_Template_Admin {

    public function action_index()
    {
        $this->set_filename('admin/blog/articles');
        if ($this->request->is_ajax())
            $this->render_partial();
    }

    public function action_new()
    {
        $this->model = new Model_Blog_Post;
        $this->set_filename('admin/blog_posts/form');
        if ($this->request->is_ajax())
            $this->render_partial();
    }

    public function action_update()
    {
    }

    public function action_destroy()
    {
        if ( ! $this->is_delete())
            throw new HTTP_Exception_403(tr('Access deny'));

        Model_Blog_Post::destroy(array(
            'id' => $this->request->param('id')
        ));
        $this->render_nothing();
    }
}
