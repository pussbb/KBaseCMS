<?php defined('SYSPATH') or die('No direct script access.');

class Model_Blog_Category extends Base_Model
{

    public function relations()
    {
        return array(
            'posts' => array(
                self::HAS_MANY,
                'Model_Blog_Post',
                'category_id',
            ),
            'articles_count' => array(
                self::STAT,
                'Model_Blog_Post',
                'category_id',
            ),
        );
    }

}
