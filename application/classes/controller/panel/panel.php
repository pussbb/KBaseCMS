<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Panel_Panel extends Controller_Core {

    public function action_index()
    {
        $r = Model_Users::find(4);
        $r->destroy();
       /// $r->limit(3);exit;
       ///var_dump($r);exit;
    }

}