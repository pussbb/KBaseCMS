<?php defined('SYSPATH') or die('No direct script access.');

class Helper_Blog {

    private static $default_filter = array('with' => array('author', 'contents', 'category', 'total_comments'), 'total_count' => TRUE);

    public static $count = NULL;

    private static $limit = NULL;

    private static $offset = NULL;

    public static function recent($limit = 10)
    {
        return self::find_by(array(), $limit);
    }

    private static function article_tr($article)
    {
        if ( ! $article->contents)
            throw new Exception("No content found");

        $lang = Language::get();
        foreach($article->contents as $tr_content)
        {
            if ($lang->id !== $tr_content->language_id)
                continue;
            $data = $tr_content->as_array();
            unset($data['id']);
            $article->update_params($data);
            return $article;
        }
        $article->update_params(Arr::get($article->contents, 0)->as_array());
        return $article;
    }

    public static function find_by($filter, $limit = 15)
    {
        $limit = Arr::get($_REQUEST, 'limit', $limit);
        $offset = Arr::get($_REQUEST, 'page', 1);

        self::$limit =  $limit ? intval($limit) : 15;
        self::$offset =  $offset ? intval($offset) : NULL;
        $offset = ( self::$offset - 1) * self::$limit ;

        if ($offset < 0)
            $offset = NULL;

        $filter = array_merge($filter, array(
            'limit' => self::$limit,
            'offset' => $offset
        ), self::$default_filter);

        $result = Model_Blog_Post::find_all($filter);
        self::$count = $result->count;

        $records = array();
        foreach($result->records as $key => $item) {
            $records[$key] = self::article_tr($item);
        }
        return $records;
    }

    public static function article($filter)
    {
        $filter = array_merge($filter, self::$default_filter);
        return self::article_tr( Model_Blog_Post::find($filter));
    }

    public static  function previous_posts()
    {
        $offset = self::$offset;
        $count = (($offset-1)*self::$limit)+self::$limit;
        if ($count >= self::$count || self::$count == 0)
            return;
        return HTML::anchor(
            Request::current()->uri().URL::query(array('page' => ++$offset, 'limit' => self::url_limit_value())),
            tr('Previous posts'),
            array('class' => 'read-more btn btn-inverse btn-small')
        );
    }

    public static  function next_posts()
    {
        $offset = self::$offset;
        if (--$offset <= 0)
            return;

        if ($offset == 0)
            $offset = NULL;

        return HTML::anchor(
            Request::current()->uri().URL::query(array('page' => $offset, 'limit' => self::url_limit_value())),
            tr('Next posts'),
            array('class' => 'read-more btn btn-inverse btn-small pull-right')
        );
    }

    private static function url_limit_value()
    {
        return isset($_REQUEST['limit'])?self::$limit : NULL;
    }
 }
