<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Blog_Archive extends Controller_Template_Blog {

    public function action_index()
    {
        $year = $this->request->param('year');
        $month = $this->request->param('month');

        if ( ! $year && ! $month )
            return $this->index();

        if ($month)
            $expression = array('YEAR(%s) = %s AND MONTH(%s) = %s', 'created_at' => array($year, intval($month)));
        else
            $expression = array('YEAR(%s) = %s ', 'created_at' => $year,);

        $this->articles = Helper_Blog::find_by(array(
            'expression' => $expression,
        ));

        $this->set_filename('blog/articles_collection');
        $this->set_title(tr('Articles over a period %s %s ', array($year, Text::month_name($month))));
    }

    private function index()
    {
        $this->layout = NULL;
        Media::bundle('backbone');
        Media::bundle('blog_archives');
        $this->set_title(tr('Blog Archives'));
    }
}
