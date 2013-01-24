<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Welcome extends Controller_Core {

    protected  $check_access = FALSE;

    public function action_index()
    {
$model = Model_Blog_Post::find_all(array(
    'with' => array('contents', 'comments'),
    'contents.id' => 'comments.post_id',
));
var_dump((string)$model, true);exit;
    }

} // End Welcome
