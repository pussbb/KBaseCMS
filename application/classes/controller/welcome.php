<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Welcome extends Controller_Core {

    public function before()
    {
        Auth::instance()->logout();
        parent::before();
    }

    public function action_index()
    {
        $this->register_css_file('impress/impress-demo');
        $this->register_js_file('impress/impress');
    }

    public function action_about_us()
    {

    }

    public function action_contact()
    {

    }

    public function action_login()
    {
       echo 'fffdf';
       $model = Model_Users::find(9);

       var_dump($model->login);
       exit;
    }

    public function action_register()
    {
        $this->view->errors = array();

        if ( ! $_REQUEST)
            return ;

        $model = new Model_Users(array(
            'login' => Arr::get($_REQUEST, 'user_name'),
            'email' => Arr::get($_REQUEST, 'email'),
            'password' => Arr::get($_REQUEST, 'pswd'),
        ));
        if ( ! $model->register())
        {
            $this->view->errors = $model->errors();
        }
    }
} // End Welcome
