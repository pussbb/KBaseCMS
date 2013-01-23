<?php defined('SYSPATH') or die('No direct script access.');

class Model_Blog_Category extends Model
{

    public function relations()
    {
        return array(
            'posts' => array(
                Model::HAS_MANY,
                'Model_Blog_Post',
                'category_id',
            ),
            'articles_count' => array(
                Model::STAT,
                'Model_Blog_Post',
                'category_id',
            ),
        );
    }

}
