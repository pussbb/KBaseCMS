<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Blog_Categories extends Controller_Template_Blog {


    public function action_index()
    {
        $category_sql = Model_Blog_Category::select_query('id', array(
                'id' => $this->request->param('id'),
                '|| parent_id' => $this->request->param('id'),
        ));
        $this->articles = Helper_Blog::find_by(array(
            'category_id' => $category_sql,
        ));
       /// debug($this->articles, true);
    }

} 
