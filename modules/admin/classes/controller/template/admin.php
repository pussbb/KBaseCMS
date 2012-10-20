<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Template_Admin extends Controller_Core {

    protected $check_access = FALSE;

    public $template = 'template/admin';

    protected $bundles = array('admin');

    public function before()
    {
      parent::before();
      $this->current_user = Auth::instance()->current_user();
    }
}