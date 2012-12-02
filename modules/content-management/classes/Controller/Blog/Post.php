<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Blog_Post extends Controller_Core {

    protected  $check_access = FALSE;

    public function action_index()
    {
      try {
          $model = Model_Blog_Post::find(array(
            'uri' => $this->request->param('id')
          ));
      } catch(Exception $e) {
          throw new HTTP_Exception_404();

      }
    }

} // End Welcome
