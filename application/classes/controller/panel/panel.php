<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Panel_Panel extends Controller_Core {

    public function action_index()
    {
        $r = Model_Users::find(5);///exit;
        $r->id = 'dssds';
        $r->save();
        //$r->destroy();
       /// $r->limit(3);exit;
       debug($r);exit;
    }

}