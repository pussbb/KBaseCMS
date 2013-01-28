<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Blog_Comments extends Controller_Template_Blog {

    public function before()
    {
        parent::before();
        if (!Auth::instance()->logged_in())
            throw new HTTP_Exception_403(tr('Access deny'));
    }

    public function action_update()
    {
        $this->model = new Model_Blog_Post_Comment(array(
            'author_id' => Auth::instance()->current_user()->id,
            'content' => Text::xss_clean(Arr::get($_REQUEST, 'content')),
            'created_at' => strtotime('now'),
            'post_id' => Arr::get($_REQUEST, 'post_id'),
        ));

        if ($this->model->save()) {
            if ($this->is_ajax())
                return $this->render_nothing();
            return $this->redirect(URL::site('article/'.$this->model->post->uri));
        }
        $this->set_filename('blog/comments/form');
        $this->set_title('Add comment');
    }

}
