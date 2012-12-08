<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Admin_Users extends Controller_Template_Admin {

    public function action_index()
    {
      if ($this->request->is_ajax())
        $this->render_partial();
    }


    public function action_destroy()
    {
        if ( ! $this->is_delete())
            throw new HTTP_Exception_403(tr('Access deny'));

        Model_User::destroy($this->request->param('id'));
        $this->render_nothing();
    }

    public function action_details()
    {
        $this->user = Model_User::find($this->request->param('id'));
        if ($this->request->is_ajax())
            $this->render_partial();
    }
}
