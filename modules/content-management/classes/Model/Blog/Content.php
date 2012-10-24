<?php defined('SYSPATH') or die('No direct script access.');

class Model_Blog_Content extends Model
{

    public function relations()
    {
        return array(
            'post' => array(
                Model::HAS_ONE,
                'Model_Blog_Post',
                'post_id',
            ),
            'language' => array(
                Model::HAS_MANY,
                'Model_Language',
                'language_id',
            ),
        );
    }

}
