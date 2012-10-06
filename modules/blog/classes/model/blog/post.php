<?php defined('SYSPATH') or die('No direct script access.');

class Model_Blog_Post extends Model
{
    protected $order = array('created_at', 'DESC');

    public function relations()
    {
        return array(
            'author' => array(
                Model::HAS_ONE,
                'Model_User',
                'author_id',
            ),
            'comments' => array(
                Model::HAS_MANY,
                'Model_Blog_Comment',
                'post_id',
            ),
            'contents' => array(
                Model::HAS_MANY,
                'Model_Blog_Content',
                'post_id',
            ),
        );
    }

}
