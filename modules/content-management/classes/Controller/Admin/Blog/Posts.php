<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Admin_Blog_Posts extends Controller_Template_Admin {

    public function action_index()
    {
        $this->set_filename('admin/blog/articles');
    }

    public function action_new()
    {
        $this->model = new Model_Blog_Post;
        $this->set_filename('admin/blog_posts/form');
    }


    public function action_edit()
    {
        $this->set_filename('admin/blog_posts/form');
        $this->model = Model_Blog_Post::find(array(
            'id' => $this->request->param('id'),
            'with' => 'contents'
        ));
    }

    public function action_update()
    {
        $this->model = new Model_Blog_Post(array(
            'uri' => Arr::get($_REQUEST, 'uri'),
            'author_id' => Auth::instance()->current_user()->id,
            'created_at' => strtotime('now'),
            'category_id' => Arr::get($_REQUEST, 'category_id')
        ));

        $id = Arr::get($_REQUEST, 'id');

        if ($id)
            $this->model->id = $id;

        if ($this->model->save())
        {
            $content_saved = 0;
            $contents = array();
            foreach(Arr::get($_REQUEST, 'post') as $lang_id => $content)
            {
                $content_model = new Model_Blog_Post_Content(array(
                    'language_id' => $lang_id,
                    'brief' => Text::truncate($content['content']),
                    'content' => $content['content'],
                    'title' => $content['title'],
                    'keywords' => $content['keywords'],
                    'post_id' => $this->model->id,
                ));

                if ($content['id'])
                    $content_model->id = $content['id'];

                if ( $content_model->save())
                    $content_saved++;
                $contents[] = $content_model;
            }
            $this->model->contents = $contents;
            if ( ! $content_saved ) {
                $this->set_filename('admin/blog_posts/form');
                if ( ! $id )
                    $this->model->destroy();
                return;
            }

            if ($this->request->is_ajax())
                return $this->render_nothing();
            self::redirect(URL::site('admin/blog_posts'));
            return;
        }
        $this->set_filename('admin/blog_posts/form');
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
