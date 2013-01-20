<?php defined('SYSPATH') or die('No direct script access.');

class Helper_Blog {

    private static $default_filter = array('with' => array('author', 'contents'));

    public static function recent($limit = 15)
    {
        $records = Model_Blog_Post::find_all(array(
            'with' => array('author', 'contents'),
            'limit' => 15,
        ))->records;

        foreach($records as $key => $item) {
            $records[$key] = self::article_tr($item);
        }
        return $records;
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
            $article->update_params($tr_content->as_array());
            return $article;
        }
        $article->update_params(Arr::get($article->contents, 0)->as_array());
        return $article;
    }

    public static function find_by($filter)
    {
        $limit = Arr::get($_REQUEST, 'articles_count');
        $offset = Arr::get($_REQUEST, 'articles_count');
        $filter = array_merge($filter, array(
            'limit' => $limit ? intval($limit) : 15,
            'offset' => $offset ? intval($offset) : NULL,
        ),self::$default_filter);
        $records =  Model_Blog_Post::find_all($filter)->records;
        foreach($records as $key => $item) {
            $records[$key] = self::article_tr($item);
        }
        return $records;
    }

    public static function article($filter)
    {
        $filter = array_merge($filter, self::$default_filter);
        return self::article_tr( Model_Blog_Post::find($filter));
    }
 }
