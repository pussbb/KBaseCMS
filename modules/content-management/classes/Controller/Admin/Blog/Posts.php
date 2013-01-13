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


    public function action_edit()
    {
        $this->model = Model_Blog_Post::find(array(
            'id' => $this->request->param('id'),
            'with' => 'contents'
        ));
        debug($this->model, true);
    }

    public function action_update()
    {
        $this->model = new Model_Blog_Post(array(
            'uri' => Arr::get($_REQUEST, 'uri'),
            'author_id' => Auth::instance()->current_user()->id,
            'created_at' => strtotime('now'),
            'category_id' => Arr::get($_REQUEST, 'category_id'),
        ));

        if ($this->model->save())
        {
            foreach(Arr::get($_REQUEST, 'post') as $lang_id => $content)
            {
                $content_model = new Model_Blog_Post_Content(array(
                    'language_id' => $lang_id,
                    'brief' => $content['content'],
                    'content' => $content['content'],
                    'title' => $content['title'],
                    'keywords' => $content['keywords'],
                    'post_id' => $this->model->id,
                ));
                $content_model->save();
            }
            if ($this->request->is_ajax())
                return $this->render_nothing();
            self::redirect(URL::site('admin'));
        }
        if ($this->request->is_ajax())
            return $this->render_partial('admin/blog_posts/form');
        $this->render_nothing();
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
