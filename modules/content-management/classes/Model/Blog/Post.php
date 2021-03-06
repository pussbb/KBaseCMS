<?php defined('SYSPATH') or die('No direct script access.');

class Model_Blog_Post extends Base_Model
{
    protected $order = array('created_at', 'DESC');

    public function relations()
    {
        return array(
            'author' => array(
                self::BELONGS_TO,
                'Model_User',
                'author_id',
            ),
            'comments' => array(
                self::HAS_MANY,
                'Model_Blog_Post_Comment',
                'post_id',
            ),
            'total_comments' => array(
                self::STAT,
                'Model_Blog_Post_Comment',
                'post_id',
            ),
            'contents' => array(
                self::HAS_MANY,
                'Model_Blog_Post_Content',
                'post_id',
            ),
            'category' => array(
                self::BELONGS_TO,
                'Model_Blog_Category',
                'category_id'
            )
        );
    }

    public function labels()
    {
        return array(
            'id' => tr('ID'),
            'title' => tr('Title'),
            'created_at' => tr('Created at'),
            'uri' => tr('URI'),
        );
    }

    public function rules()
    {
        return array(
            'uri' => array('unique'),
        );
    }

}
