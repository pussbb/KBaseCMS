<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Blog_Categories extends Controller_Template_Blog {


    public function action_index()
    {
        $id = $this->request->param('id');

        $this->category = Model_Blog_Category::find($id);
        $category_sql = Model_Blog_Category::select_query('id', array(
                'id' => $id,
                '|| parent_id' => $id,
        ));

        $this->articles = Helper_Blog::find_by(array(
            'category_id' => $category_sql,
        ));

        $this->set_filename('blog/articles_collection');
        $this->set_title($this->category->name);
    }

}
