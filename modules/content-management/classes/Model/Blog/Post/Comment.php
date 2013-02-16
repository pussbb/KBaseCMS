<?php defined('SYSPATH') or die('No direct script access.');

class Model_Blog_Post_Comment extends Model
{
    protected $order = array('created_at', 'DESC');

    public function relations()
    {
        return array(
            'post' => array(
                Model::HAS_ONE,
                'Model_Blog_Post',
                'post_id'
            ),
            'author' => array(
                Model::HAS_ONE,
                'Model_User',
                'author_id',
            ),
        );
    }

}
