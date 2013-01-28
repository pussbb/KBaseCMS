<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Blog_Post extends Controller_Template_Blog {

    public function action_index()
    {
        try {
            $this->article = Helper_Blog::article(array(
                'uri' => $this->request->param('id')
            ));
            $this->set_title($this->article->title);
            $this->set_keywords($this->article->keywords);
        } catch(Base_Db_Exception_RecordNotFound $e) {
            throw new HTTP_Exception_404();
        }
    }

} // End Welcome
