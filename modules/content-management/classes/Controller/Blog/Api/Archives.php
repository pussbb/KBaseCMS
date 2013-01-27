<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Blog_Api_Archives extends Controller_API {

    public function action_years()
    {
        $dates = Model_Blog_Post::select_query('created_at')->execute()->as_array();
        $dates = Arr::pluck($dates, 'created_at');
        $result = array();
        foreach($dates as $date) {
            $year = date('Y', strtotime($date));
            if (isset($result[$year])) {
                $result[$year]['count'] = $result[$year]['count']+1;
                continue;
            }
            $result[$year] = array(
                'id' => $year,
                'name' => $year,
                'count' => 1,
            );
        }
       /// $result[2012] = array('id' => 2012, 'name' => 2012);
        arsort($result);
        $this->result = array_values($result);
    }

    public function action_months()
    {
        $year = Arr::get($_REQUEST, 'year');
        $expression = array('YEAR(%s) = %s ', 'created_at' => $year,);

        $dates = Model_Blog_Post::select_query('created_at', array('expression' => $expression))
            ->execute()
            ->as_array();

        $dates = Arr::pluck($dates, 'created_at');
        $result = array();
        foreach($dates as $date) {
            $month = date('m', strtotime($date));
            if (isset($result[$month])) {
                $result[$month]['count'] = $result[$month]['count']+1;
                continue;
            }
            $result[$month] = array(
                'id' => $month,
                'name' => Text::month_name($month),
                'count' => 1,
            );
        }
        $this->result = array_values($result);
    }

    public function action_articles()
    {
        $year = Arr::get($_REQUEST, 'year');
        $month = Arr::get($_REQUEST, 'month');
        $expression = array('YEAR(%s) = %s AND MONTH(%s) = %s', 'created_at' => array($year, intval($month)));

        $articles = Helper_Blog::find_by(array(
            'expression' => $expression,
        ));

        $this->result = array();
        foreach($articles as $article) {
            $this->result[] = array(
                'id' => $article->id,
                'url' => URL::site('article/'.$article->uri),
                'title' => $article->title
            );
        }

    }
}
