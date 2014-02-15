<?php defined('SYSPATH') or die('No direct script access.');

class Model_News extends Base_Model
{
    protected $order = array('created_at', 'ASC');

    public function relations()
    {
        return array(
            'author' => array(
                self::BELONGS_TO,
                'Model_User',
                'author_id',
            ),
        );
    }

    public function labels()
    {
        return array(
            'id' => tr('Id'),
            'title' => tr('Title'),
            'author_id' => tr('Author'),
            'content' => tr('Content'),
            'created_at' => tr('Created at')
        );
    }
}
