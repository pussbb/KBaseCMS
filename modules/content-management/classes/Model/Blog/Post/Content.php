<?php defined('SYSPATH') or die('No direct script access.');

class Model_Blog_Post_Content extends Base_Model
{

    public function relations()
    {
        return array(
            'post' => array(
                self::BELONGS_TO,
                'Model_Blog_Post',
                'post_id',
            ),
            'language' => array(
                self::HAS_MANY,
                'Model_Language',
                'language_id',
            ),
        );
    }

}
