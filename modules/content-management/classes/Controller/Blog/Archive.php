<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Blog_Archive extends Controller_Template_Blog {


    public function action_index()
    {
        $year = $this->request->param('year');
        $month = $this->request->param('month');
        if ($month)
            $expression = array('YEAR(%s) = %s AND MONTH(%s) = %s', 'created_at' => array($year, intval($month)));
        else
            $expression = array('YEAR(%s) = %s ', 'created_at' => $year,);

        $this->articles = Helper_Blog::find_by(array(
            'expression' => $expression,
        ));

        $this->set_filename('blog/articles_collection');
    }

}
