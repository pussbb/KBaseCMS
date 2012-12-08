<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Admin_Logs extends Controller_Template_Admin {

    public function action_index()
    {
        if ($this->request->is_ajax())
            $this->render_partial();
    }

    public function action_view()
    {
        $this->file = $this->request->param('id');
        if ($this->request->is_ajax())
            $this->render_partial();
    }

    public function action_destroy()
    {
        if ( ! $this->is_delete())
            throw new HTTP_Exception_403(tr('Access deny'));
        unlink(APPPATH.'logs'.DIRECTORY_SEPARATOR.str_replace('-', DIRECTORY_SEPARATOR, $this->request->param('id')).'.php');
        $this->render_nothing();
    }
}
