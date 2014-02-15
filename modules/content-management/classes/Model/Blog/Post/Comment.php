<?php defined('SYSPATH') or die('No direct script access.');

class Model_Blog_Post_Comment extends Base_Model
{
    protected $order = array('created_at', 'DESC');

    public function relations()
    {
        return array(
            'post' => array(
                self::BELONGS_TO,
                'Model_Blog_Post',
                'post_id'
            ),
            'author' => array(
                self::BELONGS_TO,
                'Model_User',
                'author_id',
            ),
        );
    }

}
