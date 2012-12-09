<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Blog_Categories extends Controller_Template_Blog {


    public function action_index()
    {
        $this->articles = Model_Blog_Post::find_all(array(
            'category_id' => Model_Blog_Category::select_query('id', array(
                'id' => $this->request->param('id'),
                '|| parent_id' => $this->request->param('id'),
            )),
        ));
//         debug($this->articles, true);
    }

} 
